<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forgot-password page (email + new password in one form).
     */
    public function showForm(): View
    {
        return view('forgot-password');
    }

    /**
     * Look the user up by email and set their new password directly,
     * then send them to the login page.
     *
     * Note: this skips the emailed reset-link/token step, so anyone
     * who knows (or guesses) a valid account email can change that
     * account's password from this page. If that's not the intended
     * tradeoff, consider adding a verification step (e.g. OTP sent to
     * the email) before allowing the update.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'We could not find a user with that email address.',
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        return redirect()->route('login')
            ->with('status', 'Your password has been reset. Please login.');
    }
}