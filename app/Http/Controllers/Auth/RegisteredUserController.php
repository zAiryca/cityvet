<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'regex:/^09\d{10}$/', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,admin'],
            'terms' => ['required', 'accepted'],
        ]);

        // Check for duplicate first+middle+last name combination (case-insensitive)
        $firstLower = Str::lower($request->first_name);
        $middleLower = $request->middle_name ? Str::lower($request->middle_name) : null;
        $lastLower = Str::lower($request->last_name);

        // Build the query to check for duplicates
        $query = User::whereRaw('LOWER(first_name) = ?', [$firstLower])
                     ->whereRaw('LOWER(last_name) = ?', [$lastLower]);

        // Check middle name: if both are null or both match (case-insensitive)
        if ($middleLower === null) {
            $query->whereNull('middle_name');
        } else {
            $query->whereRaw('LOWER(middle_name) = ?', [$middleLower]);
        }

        if ($query->exists()) {
            return back()
                ->withErrors(['first_name' => 'A user with this name combination already exists. Please use a different name or add a middle name to differentiate.'])
                ->withInput();
        }

        $user = User::create([
            'first_name' => Str::title($request->first_name),
            'middle_name' => $request->middle_name ? Str::title($request->middle_name) : null,
            'last_name' => Str::title($request->last_name),
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Login the user after registration
        Auth::login($user);

        // Since User implements MustVerifyEmail, always redirect to verification.notice
        // The conditional is unnecessary because new users haven't verified their email yet
        return redirect(route('verification.notice', absolute: false));
    }
}
