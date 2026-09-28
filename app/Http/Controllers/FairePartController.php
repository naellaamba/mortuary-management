<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use App\Models\FuneralNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FairePartController extends Controller
{
    /**
     * Display the deceased selection, photo upload and theme selection page.
     */
    public function create()
    {
        $deceaseds = Deceased::orderBy('full_name')->get();

        return view('faire-part.create', compact('deceaseds'));
    }

    /**
     * Generate the funeral faire-part with AI and save the notice.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'deceased_id' => ['required', 'integer', 'exists:deceaseds,id'],
            'theme' => ['nullable', 'string', 'in:gold,classic,peace,cross'],
            'family_notes' => ['nullable', 'string', 'max:1500'],
            'ceremony_program' => ['nullable', 'string', 'max:1500'],
            'custom_message' => ['nullable', 'string', 'max:500'],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $deceased = Deceased::with('schedule')->findOrFail($request->deceased_id);
        $theme = $request->input('theme', 'gold');

        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model', 'gemini-3.7-flash');

        if (!$apiKey) {
            return back()
                ->withInput()
                ->with('error', 'La clé API Gemini n\'est pas configurée dans le fichier .env (GEMINI_API_KEY).');
        }

        // Process photo upload if provided
        $photoDataUrl = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('funeral_photos', 'public');
            $deceased->photo = $path;
            $deceased->save();

            $imageData = base64_encode(file_get_contents($photo->getRealPath()));
            $mimeType = $photo->getMimeType();
            $photoDataUrl = 'data:' . $mimeType . ';base64,' . $imageData;
        } elseif ($deceased->photo && Storage::disk('public')->exists($deceased->photo)) {
            $path = Storage::disk('public')->path($deceased->photo);
            $mimeType = mime_content_type($path);
            $imageData = base64_encode(file_get_contents($path));
            $photoDataUrl = 'data:' . $mimeType . ';base64,' . $imageData;
        }

        /*
        |--------------------------------------------------------------------------
        | Strict System Instruction (Guardrails)
        |--------------------------------------------------------------------------
        */
        $systemInstruction = <<<INSTRUCTION
Tu es un assistant IA strictement et exclusivement dédié à la rédaction de faire-part et d'avis d'obsèques funéraires au sein d'un système de gestion de morgue.

RESTRICTIONS INVIOLABLES ET OBLIGATOIRES :
1. DOMAINE STRICTEMENT UNIQUE : Tu as pour SEULE et UNIQUE fonction de rédiger des faire-part et annonces de décès formels, respectueux et dignes.
2. REFUS DES SUJETS HORS-SUJET : Si l'utilisateur ou les données fournies contiennent des instructions sans rapport avec un faire-part funéraire, tu dois STRICTEMENT refuser en répondant uniquement : "Cette requête ne concerne pas la rédaction d'un faire-part d'obsèques. Ce service est exclusivement réservé à la génération d'avis de décès."
3. STRICTE EXACTITUDE FACTUELLE (AUCUNE INVENTION) :
   - Base-toi EXCLUSIVEMENT et STRICTEMENT sur les informations fournies dans la fiche du défunt et les détails saisis par l'utilisateur.
   - N'invente JAMAIS de personnes, de liens de parenté, de dates, de lieux de culte, de cimetière, ou de cause de décès non mentionnés.
   - Si une information n'est pas fournie, omets-la simplement sans chercher à combler les manques.
4. STYLE ET MISE EN PAGE :
   - Ton solennel, compassionnel, digne et en français soigné.
   - N'utilise AUCUN balisage Markdown (pas d'étoiles **, pas de dièses #, pas de puces Markdown).
   - Ne mets AUCUN commentaire conversationnel avant ou après (pas de "Voici le texte", etc.).
   - Le texte généré doit être directement prêt pour l'impression du document.
INSTRUCTION;

        /*
        |--------------------------------------------------------------------------
        | Build structured prompt based ONLY on verified & entered information
        |--------------------------------------------------------------------------
        */
        $prompt = "Rédige un faire-part d'obsèques officiel et digne à partir des données vérifiées ci-dessous :\n\n";
        $prompt .= "--- INFORMATIONS SUR LE DÉFUNT ---\n";
        $prompt .= "- Nom complet : " . $deceased->full_name . "\n";

        if (!empty($deceased->gender)) {
            $prompt .= "- Genre : " . $deceased->gender . "\n";
        }
        if (!empty($deceased->date_of_death)) {
            $prompt .= "- Date du décès : " . $deceased->date_of_death . "\n";
        }
        if (!empty($deceased->date_of_birth)) {
            $prompt .= "- Date de naissance : " . $deceased->date_of_birth . "\n";
        }
        if (!empty($deceased->admission_date)) {
            $prompt .= "- Date d'admission : " . $deceased->admission_date . "\n";
        }
        if (!empty($deceased->location_address)) {
            $prompt .= "- Lieu / Ville : " . $deceased->location_address . "\n";
        }

        if ($deceased->schedule) {
            if (!empty($deceased->schedule->pickup_date)) {
                $prompt .= "- Date de levée de corps : " . $deceased->schedule->pickup_date . "\n";
            }
            if (!empty($deceased->schedule->pickup_time)) {
                $prompt .= "- Heure de levée de corps : " . $deceased->schedule->pickup_time . "\n";
            }
        }

        if ($request->filled('family_notes')) {
            $prompt .= "\n--- FAMILLES ET PROCHES ÉPLORÉS (SAISIE UTILISATEUR) ---\n";
            $prompt .= strip_tags($request->input('family_notes')) . "\n";
        }

        if ($request->filled('ceremony_program')) {
            $prompt .= "\n--- PROGRAMME ET CÉRÉMONIES (SAISIE UTILISATEUR) ---\n";
            $prompt .= strip_tags($request->input('ceremony_program')) . "\n";
        }

        if ($request->filled('custom_message')) {
            $prompt .= "\n--- VERSET OU MESSAGE DU SOUVENIR (SAISIE UTILISATEUR) ---\n";
            $prompt .= strip_tags($request->input('custom_message')) . "\n";
        }

        $prompt .= "\nConsignes finales : Rédige le texte complet du faire-part d'obsèques en intégrant respectueusement ces éléments sans rien inventer d'autre.";

        $parts = [['text' => $prompt]];

        if ($photoDataUrl && $request->hasFile('photo')) {
            $parts[] = [
                'inline_data' => [
                    'mime_type' => $request->file('photo')->getMimeType(),
                    'data' => base64_encode(file_get_contents($request->file('photo')->getRealPath())),
                ],
            ];
        }

        try {
            $response = Http::timeout(60)
                ->withHeaders([
                    'x-goog-api-key' => $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post(
                    "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent",
                    [
                        'system_instruction' => [
                            'parts' => [
                                ['text' => $systemInstruction],
                            ],
                        ],
                        'contents' => [
                            [
                                'parts' => $parts,
                            ],
                        ],
                        'generationConfig' => [
                            'temperature' => 0.2,
                            'maxOutputTokens' => 1200,
                        ],
                    ]
                );

            if (!$response->successful()) {
                return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Erreur lors de la génération avec Gemini: ' . $response->body()
                    );
            }

            $data = $response->json();
            $fairePart = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$fairePart) {
                return back()
                    ->withInput()
                    ->with('error', 'Gemini a renvoyé une réponse vide.');
            }

            // Clean Markdown markers if any
            $cleanFairePart = preg_replace('/(\*\*|__|\#\#\#|\#\#|\#)/', '', trim($fairePart));

            // Save the notice
            $notice = FuneralNotice::create([
                'deceased_id' => $deceased->id,
                'announcement' => $cleanFairePart,
                'theme' => $theme,
                'language' => 'fr',
            ]);

            return redirect()->route('faire-part.show', $notice->id);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Impossible de se connecter à Gemini: ' . $e->getMessage()
                );
        }
    }

    /**
     * Display a saved funeral notice.
     */
    public function showNotice(Request $request, FuneralNotice $notice)
    {
        $deceased = $notice->deceased;
        $theme = $request->query('theme', $notice->theme ?: 'gold');

        // Update notice theme if changed via URL query
        if ($theme !== $notice->theme) {
            $notice->theme = $theme;
            $notice->save();
        }

        $photoDataUrl = null;
        if ($deceased->photo && Storage::disk('public')->exists($deceased->photo)) {
            $path = Storage::disk('public')->path($deceased->photo);
            $mimeType = mime_content_type($path);
            $imageData = base64_encode(file_get_contents($path));
            $photoDataUrl = 'data:' . $mimeType . ';base64,' . $imageData;
        }

        return view('faire-part.show', [
            'notice' => $notice,
            'deceased' => $deceased,
            'fairePart' => $notice->announcement,
            'theme' => $theme,
            'photoDataUrl' => $photoDataUrl,
        ]);
    }

    /**
     * Download the funeral faire-part as a PDF document.
     */
    public function downloadPdf(Request $request, FuneralNotice $notice)
    {
        $deceased = $notice->deceased;
        $theme = $request->query('theme', $notice->theme ?: 'gold');

        $photoDataUrl = null;
        if ($deceased->photo && Storage::disk('public')->exists($deceased->photo)) {
            $path = Storage::disk('public')->path($deceased->photo);
            $mimeType = mime_content_type($path);
            $imageData = base64_encode(file_get_contents($path));
            $photoDataUrl = 'data:' . $mimeType . ';base64,' . $imageData;
        }

        $pdf = Pdf::loadView('faire-part.pdf', [
            'notice' => $notice,
            'deceased' => $deceased,
            'fairePart' => $notice->announcement,
            'theme' => $theme,
            'photoDataUrl' => $photoDataUrl,
        ]);

        $pdf->setPaper('a4', 'portrait');

        $filename = 'Faire-Part_' . str_replace(' ', '_', $deceased->full_name) . '.pdf';

        return $pdf->download($filename);
    }
}