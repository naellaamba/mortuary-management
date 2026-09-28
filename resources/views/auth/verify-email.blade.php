<x-guest-layout>
    <div>
        <div class="mb-4">
            <h2 class="form-title">Verify Email</h2>
            <p class="form-subtitle">Please check your inbox to verify your email address.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success border-0 mb-4" style="background: rgba(16, 185, 129, 0.15); color: #6ee7b7; font-size: 0.88rem;">
                <i class="bi bi-check-circle-fill me-2"></i> A new verification link has been sent to your registered email address.
            </div>
        @endif

        <div class="d-flex flex-column gap-3 mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-auth-submit">
                    <span>Resend Verification Email</span>
                    <i class="bi bi-send"></i>
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit" class="btn btn-link text-muted text-decoration-none small">
                    <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
