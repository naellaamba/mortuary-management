<x-guest-layout>
    <div>
        <div class="mb-4">
            <h2 class="form-title">Reset Password</h2>
            <p class="form-subtitle">Enter your email and we'll send you a password reset link.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3 text-info" :status="session('status')" />

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3 border-0" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5; font-size: 0.85rem; border-radius: 8px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="input-group-custom">
                <i class="bi bi-envelope input-icon"></i>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="auth-input"
                    placeholder="Enter your email address"
                >
            </div>

            <button type="submit" class="btn-auth-submit mt-2">
                <span>Email Password Reset Link</span>
                <i class="bi bi-arrow-right"></i>
            </button>

            <div class="text-center mt-4" style="font-size: 0.88rem;">
                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">
                    &larr; Back to sign in
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
