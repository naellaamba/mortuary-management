<x-guest-layout>
    <div>
        <div class="mb-4">
            <h2 class="form-title">Welcome Back</h2>
            <p class="form-subtitle">Enter your credentials to access the system</p>
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

        <form method="POST" action="{{ route('login') }}" id="loginForm">
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
                    autocomplete="username"
                    class="auth-input"
                    placeholder="Enter your email"
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
                    autocomplete="current-password"
                    class="auth-input"
                    placeholder="Enter your password"
                >
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4 text-sm" style="font-size: 0.85rem;">
                <label for="remember_me" class="d-inline-flex align-items-center text-muted cursor-pointer">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="form-check-input me-2"
                        name="remember"
                        style="background-color: #0f172a; border-color: rgba(255,255,255,0.2);"
                    >
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-auth-submit">
                <span>Sign In to Dashboard</span>
                <i class="bi bi-arrow-right"></i>
            </button>

            <!-- Demo Credentials Helper -->
            <div class="demo-credentials-box">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="small fw-semibold text-muted" style="font-size: 0.75rem;">⚡ Quick Demo Login:</span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="demo-pill flex-grow-1 text-center border-0" onclick="fillCredentials('admin@example.com', 'password')">
                        <i class="bi bi-shield-lock me-1"></i> Admin
                    </button>
                    <button type="button" class="demo-pill flex-grow-1 text-center border-0" onclick="fillCredentials('staff@example.com', 'password')">
                        <i class="bi bi-person-badge me-1"></i> Staff
                    </button>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4" style="font-size: 0.88rem;">
                <span class="text-muted">Don't have an account yet?</span>
                <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold ms-1">
                    Create an account
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function fillCredentials(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
        }
    </script>
    @endpush
</x-guest-layout>
