<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    /**
     * Show both impounded and adoptable pets
     */
    public function index()
    {
        $impoundedPets = Pet::where('status', 'impounded')->get();
        $adoptablePets = Pet::where('status', 'adoptable')->get();

        return view('pets.index', compact('impoundedPets', 'adoptablePets'));
    }

    /**
     * Handle pet request (claim or adopt)
     */
    public function request(Request $request, Pet $pet)
    {
        $type = $request->type;  // 'claim' or 'adopt' from form

        // Validation
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
            'contact_info' => 'required|string|max:255',
        ]);

        // Logic
        if ($pet->status === 'impounded' && $type !== 'claim') {
            return back()->with('error', 'Can only claim impounded pets.');
        }

        if ($pet->status === 'adoptable' && $type !== 'adopt') {
            return back()->with('error', 'Can only adopt adoptable pets.');
        }

        // Create Pet Request
        PetRequest::create([
            'pet_id' => $pet->id,
            'user_id' => Auth::id(),
            'type' => $type,
            'status' => 'pending',
            'reason' => $validated['reason'],
            'contact_info' => $validated['contact_info'],
        ]);

        return back()->with('success', 'Your request has been submitted and is pending review.');
    }

    /**
     * User registers their own pet
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // 2MB
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pets', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'registered';

        Pet::create($validated);

        return redirect()->route('profile')->with('success', 'Pet registered successfully!');
    }

    /**
     * Admin view of all pets
     */
    public function adminIndex()
    {
        $pets = Pet::with('user')->paginate(10);
        return view('admin.pets.index', compact('pets'));
    }

    /**
     * Mark pet as urgent adoptable (admin)
     */
    public function setUrgent(Request $request, Pet $pet)
    {
        $request->validate(['urgent_deadline' => 'required|date|after:now']);

        $pet->update([
            'status' => 'adoptable',
            'urgent_deadline' => $request->urgent_deadline,
        ]);

        return back()->with('success', 'Pet marked as urgent for adoption.');
    }
}
