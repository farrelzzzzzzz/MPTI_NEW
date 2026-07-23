<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->isLocked()) {
            $remaining = $user->getRemainingLockTime();
            $attempts = $user->login_attempts;
            return back()->with('lockout_error', "Akun Anda terkunci. Silakan coba lagi dalam {$remaining}. (Percobaan gagal: {$attempts}x)")
                ->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if ($user && $user->isAdmin()) {
                $user->resetLoginAttempts();
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            // Non-admin user trying admin login: Logout and count as failed attempt
            Auth::logout();

            if ($user) {
                $user->incrementLoginAttempts();
            }

            return back()->withErrors([
                'email' => 'Hanya admin yang dapat masuk melalui halaman ini.',
            ])->onlyInput('email');
        }

        if ($user) {
            $user->incrementLoginAttempts();
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check if user exists and is locked out
        $user = User::where('email', $request->email)->first();

        if ($user && $user->isLocked()) {
            $remaining = $user->getRemainingLockTime();
            $attempts = $user->login_attempts;
            $error = "Akun Anda terkunci. Silakan coba lagi dalam {$remaining}. (Percobaan gagal: {$attempts}x)";

            if ($request->ajax() || $request->wantsJson() || $request->has('modal_login')) {
                return response()->json(['message' => $error], 429);
            }

            return back()->with('lockout_error', $error)
                ->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Successful login: reset login attempts
            if ($user) {
                $user->resetLoginAttempts();
            }
            $request->session()->regenerate();

            if ($request->ajax() || $request->wantsJson() || $request->has('modal_login')) {
                return response()->json([
                    'redirect' => $request->input('intended', '/')
                ]);
            }

            return redirect()->intended('/');
        }

        // Failed login: increment attempts for existing user
        if ($user) {
            $user->incrementLoginAttempts();
        }

        if ($request->ajax() || $request->wantsJson() || $request->has('modal_login')) {
            return response()->json([
                'errors' => [
                    'email' => ['Email atau password yang Anda masukkan salah.']
                ]
            ], 422);
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the forgot password form.
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the given email.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', [
            'request' => $request,
            'token' => $token,
        ]);
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Show the confirm password form.
     */
    public function showConfirmForm()
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function confirmPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', PasswordRule::defaults()],
        ]);

        if (!Auth::validate($request->only('password'))) {
            return back()->withErrors([
                'password' => __('The provided password does not match our records.'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
}
