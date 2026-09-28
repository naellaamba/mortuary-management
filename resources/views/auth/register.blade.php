<x-guest-layout>
    <div>
        <div class="mb-4">
            <h2 class="form-title">Create Account</h2>
            <p class="form-subtitle">Register to manage mortuary operations & records</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 mb-3 border-0" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5; font-size: 0.85rem; border-radius: 8px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Full Name -->
            <div class="input-group-custom">
                <i class="bi bi-person input-icon"></i>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="auth-input"
                    placeholder="Enter your full name"
                >
            </div>

            <!-- Email Address -->
            <div class="input-group-custom">
                <i class="bi bi-envelope input-icon"></i>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="auth-input"
                    placeholder="Enter your email address"
                >
            </div>

            <!-- Password -->
            <div class="input-group-custom">
                <i class="bi bi-lock input-icon"></i>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="auth-input"
                    placeholder="Create a strong password"
                >
            </div>

            <!-- Confirm Password -->
            <div class="input-group-custom">
                <i class="bi bi-shield-check input-icon"></i>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="auth-input"
                    placeholder="Confirm your password"
                >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit mt-2">
                <span>Create New Account</span>
                <i class="bi bi-arrow-right"></i>
            </button>

            <!-- Login Link -->
            <div class="text-center mt-4" style="font-size: 0.88rem;">
                <span class="text-muted">Already registered?</span>
                <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold ms-1">
                    Sign in instead
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
