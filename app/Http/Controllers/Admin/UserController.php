<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) abort(403);
        $users = User::withCount(['adoptedPets', 'claimedPets', 'requests', 'eventRegistrations'])->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        $user->load(['adoptedPets', 'claimedPets', 'posters', 'requests.requestable', 'eventRegistrations.event']);
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->isAdmin()) abort(403);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'contact_number' => 'nullable|string|max:20',
            'street' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'city_municipality' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'role' => 'required|in:user,admin',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only([
            'first_name', 'middle_name', 'last_name', 'email', 'contact_number',
            'street', 'barangay', 'city_municipality', 'province', 'emergency_contact', 'role'
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        // Prevent deleting the current admin user
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
