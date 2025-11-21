<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'last_name' => Str::title($request->last_name),
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            // 💡 CRITICAL FIX: Hardcode the role to 'user' for public sign-ups.
            'role' => 'user',
        ]);

        event(new Registered($user));

        // Redirect to verification notice where they can verify their email
        return redirect(route('verification.notice', absolute: false));
    }
}
