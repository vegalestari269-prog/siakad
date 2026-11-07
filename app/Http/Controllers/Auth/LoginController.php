<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi email dan kata sandi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        // Membuat kunci pembatasan percobaan login
        $key = $this->throttleKey($request);

        // Memeriksa batas percobaan login
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $detik = RateLimiter::availableIn($key);
            $pesan = "Terlalu banyak percobaan login. Coba lagi dalam {$detik} detik.";

            return back()
                ->with('error', $pesan)
                ->onlyInput('email');
        }

        // Memeriksa email dan kata sandi
        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            // Menghapus hitungan percobaan login
            RateLimiter::clear($key);

            // Memperbarui session
            $request->session()->regenerate();

            // Menyimpan waktu login terakhir pengguna
            $request->user()->update([
                'last_login_at' => now(),
            ]);

            // Pesan login berhasil
            $pesan = 'Login berhasil. Selamat datang, '
                . Auth::user()->name . '.';

            return redirect()
                ->intended(route('dashboard'))
                ->with('success', $pesan);
        }

        // Menambah hitungan jika login gagal
        RateLimiter::hit($key, 60);

        return back()
            ->with('error', 'Email atau kata sandi tidak sesuai.')
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Mengeluarkan pengguna
        Auth::logout();

        // Menghapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda telah berhasil keluar.');
    }

    // Membuat kunci pembatasan berdasarkan email dan IP
    private function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower((string) $request->input('email'))
            . '|' . $request->ip()
        );
    }
}
