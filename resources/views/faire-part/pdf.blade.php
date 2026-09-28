<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Funeral Notice - {{ $deceased->full_name }}</title>
    <style>
        @page {
            margin: 12mm 15mm;
            size: A4 portrait;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Serif', Georgia, serif;
            color: #222222;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            line-height: 1.6;
        }

        /* ----------------------------------------------------
           THEME STYLES
        ---------------------------------------------------- */
        .container {
            width: 100%;
            padding: 25px 30px;
            text-align: center;
            border-radius: 4px;
        }

        /* Theme Gold */
        .theme-gold {
            background-color: #fdfbf7;
            border: 3px double #c5a059;
            color: #2c2317;
        }
        .theme-gold .accent-color {
            color: #966f27;
        }
        .theme-gold .divider {
            border-top: 1px solid #c5a059;
            border-bottom: 1px solid #c5a059;
            height: 4px;
            margin: 15px auto;
            width: 60%;
        }
        .theme-gold .photo-frame {
            border: 3px solid #c5a059;
            box-shadow: 0 0 0 2px #fdfbf7;
        }

        /* Theme Classic */
        .theme-classic {
            background-color: #ffffff;
            border: 3px double #1a1a1a;
            color: #111111;
        }
        .theme-classic .accent-color {
            color: #1a1a1a;
        }
        .theme-classic .divider {
            border-top: 1px solid #1a1a1a;
            border-bottom: 1px solid #1a1a1a;
            height: 3px;
            margin: 15px auto;
            width: 50%;
        }
        .theme-classic .photo-frame {
            border: 3px solid #1a1a1a;
        }

        /* Theme Peace */
        .theme-peace {
            background-color: #f8fafc;
            border: 3px double #1e3a8a;
            color: #1e293b;
        }
        .theme-peace .accent-color {
            color: #1e3a8a;
        }
        .theme-peace .divider {
            border-top: 1px solid #3b82f6;
            margin: 15px auto;
            width: 55%;
        }
        .theme-peace .photo-frame {
            border: 3px solid #1e3a8a;
        }

        /* Theme Cross */
        .theme-cross {
            background-color: #faf8f5;
            border: 3px double #4a3b32;
            color: #33261f;
        }
        .theme-cross .accent-color {
            color: #634832;
        }
        .theme-cross .divider {
            border-top: 1px solid #8c6d53;
            margin: 15px auto;
            width: 50%;
        }
        .theme-cross .photo-frame {
            border: 3px solid #634832;
        }

        /* Header Symbol */
        .header-symbol {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header-title {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Photo */
        .photo-container {
            margin: 15px auto;
        }

        .photo-frame {
            width: 130px;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
        }

        /* Deceased Name */
        .deceased-name {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 10px 0;
        }

        /* Announcement Body */
        .announcement-text {
            font-size: 12px;
            line-height: 1.7;
            text-align: justify;
            white-space: pre-line;
            margin: 15px auto;
            max-width: 90%;
        }

        .footer-note {
            font-size: 10px;
            font-style: italic;
            margin-top: 20px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

<div class="container theme-{{ $theme ?? 'gold' }}">

    <div class="header-symbol accent-color">
        @if(($theme ?? '') === 'cross')
            ✝
        @elseif(($theme ?? '') === 'peace')
            🕊
        @elseif(($theme ?? '') === 'classic')
            ✦
        @else
            🕊
        @endif
    </div>

    <div class="header-title accent-color">
        Funeral Notice & Obituary
    </div>

    <div class="divider"></div>

    @if(!empty($photoDataUrl))
        <div class="photo-container">
            <img src="{{ $photoDataUrl }}" alt="Photo" class="photo-frame">
        </div>
    @endif

    <div class="announcement-text">
        {!! nl2br(e($fairePart)) !!}
    </div>

    <div class="divider"></div>

    <div class="footer-note">
        « May their gentle soul rest in perfect peace. »
    </div>

</div>

</body>
</html>
