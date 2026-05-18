<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Log the password update attempt
        Log::info('Password update initiated for user: ' . $request->user()->id);

        // Update the password
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Log successful update
        Log::info('Password updated successfully for user: ' . $request->user()->id);

        // Return with success status (Inertia will handle this)
        return back()->with('status', 'password-updated');
    }
}

