@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-mortarboard-fill display-5 text-primary"></i>
        <h1 class="h3 fw-bold mb-1">{{ config('app.name') }}</h1>
        <p class="text-body-secondary mb-0">
            Politeknik Negeri Pontianak
        </p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h2 class="h5 mb-3">Masuk ke akun Anda</h2>

            <form method="POST"
                  action="{{ route('login.attempt') }}"
                  novalidate>
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-form-input
                        label="Email"
                        name="email"
                        type="email"
                        autocomplete="username"
                        required
                        autofocus
                    />
                </div>

                <!-- Kata Sandi -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Kata Sandi
                    </label>

                    <div class="input-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            autocomplete="current-password"
                            required
                        >

                        
					<button
						class="btn btn-outline-secondary"
						type="button"
						id="togglePassword"
						aria-label="Tampilkan kata sandi"
					>
						<svg id="iconPassword" xmlns="http://www.w3.org/2000/svg"
							 width="20" height="20" viewBox="0 0 24 24"
							 fill="none" stroke="currentColor"
							 stroke-width="2" stroke-linecap="round"
							 stroke-linejoin="round">
							<path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
							<circle cx="12" cy="12" r="3"/>
						</svg>
					</button>

                    </div>
                </div>

                <!-- Ingat Saya -->
                <div class="form-check mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                    >

                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <!-- Tombol Login -->
                <button type="submit" class="btn btn-primary w-100">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript Tampilkan/Sembunyikan Password -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = document.getElementById('iconPassword');

            if (password.type === 'password') {
                password.type = 'text';

                icon.innerHTML = `
                    <path d="M3 3l18 18"/>
                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"/>
                    <path d="M9.9 5.2A11 11 0 0 1 12 5c6.5 0 10 7 10 7a15 15 0 0 1-3 3.8"/>
                    <path d="M6.6 6.6C3.6 8.4 2 12 2 12s3.5 7 10 7c1 0 2-.2 2.9-.5"/>
                `;

                this.setAttribute('aria-label', 'Sembunyikan kata sandi');
            } else {
                password.type = 'password';

                icon.innerHTML = `
                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/>
                    <circle cx="12" cy="12" r="3"/>
                `;

                this.setAttribute('aria-label', 'Tampilkan kata sandi');
            }
        });
    </script>
@endsection
