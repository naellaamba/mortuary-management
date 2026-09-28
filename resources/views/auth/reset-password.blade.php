<x-guest-layout>
    <div>
        <div class="mb-4">
            <h2 class="form-title">Set New Password</h2>
            <p class="form-subtitle">Choose a new, secure password for your account</p>
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

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="input-group-custom">
                <i class="bi bi-envelope input-icon"></i>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    autofocus
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
                    autocomplete="new-password"
                    class="auth-input"
                    placeholder="Enter new password"
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
                    placeholder="Confirm new password"
                >
            </div>

            <button type="submit" class="btn-auth-submit mt-2">
                <span>Reset Password</span>
                <i class="bi bi-arrow-right"></i>
            </button>
        </form>
    </div>
</x-guest-layout>
