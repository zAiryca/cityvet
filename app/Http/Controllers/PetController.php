<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::paginate(12);
        return view('pets.index', compact('pets'));
    }

    public function adoptable()
    {
        $pets = Pet::where('status', 'adoptable')->visibleToUsers()->paginate(12);
        return view('pets.adoptable', compact('pets'));
    }

    public function impounded()
    {
        $pets = Pet::where('status', 'impounded')->visibleToUsers()->paginate(12);
        return view('pets.impounded', compact('pets'));
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function request(Request $request, Pet $pet)
    {
        if ($request->type === 'adopt') {
            $request->validate([
                'type' => 'required|in:adopt,claim',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'address' => 'required|string',
                'contact_number' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'date_of_birth' => 'required|date',
                'dwelling_type' => 'required|in:owned,rented,apartment',
                'landlord_permission' => 'nullable|in:yes,no,n/a',
                'fenced_property' => 'required|in:yes,no',
                'adults_count' => 'required|integer|min:1',
                'children_count' => 'required|integer|min:0',
                'allergies' => 'required|in:yes,no,unsure',
                'other_pets' => 'required|in:yes,no',
                'other_pets_list' => 'nullable|string',
                'pet_living_area' => 'required|in:indoors,outdoors,both',
                'reason' => 'required|string',
                'certify_info' => 'required|accepted',
                'agree_terms' => 'required|accepted',
                'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);
        } elseif ($request->type === 'claim') {
            $request->validate([
                'type' => 'required|in:adopt,claim',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'address' => 'required|string',
                'contact_number' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'proof_of_ownership_description' => 'required|string|max:1000',
                'photos' => 'nullable|array',
                'photos.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
                'certify_info' => 'required|accepted',
                'agree_terms' => 'required|accepted',
            ]);
        }

        // Prepare additional data
        $additionalData = [];
        if ($request->type === 'adopt') {
            $additionalData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'dwelling_type' => $request->dwelling_type,
                'landlord_permission' => $request->landlord_permission,
                'fenced_property' => $request->fenced_property,
                'adults_count' => $request->adults_count,
                'children_count' => $request->children_count,
                'allergies' => $request->allergies,
                'other_pets' => $request->other_pets,
                'other_pets_list' => $request->other_pets_list,
                'pet_living_area' => $request->pet_living_area,
                'certify_info' => $request->certify_info,
                'agree_terms' => $request->agree_terms,
            ];
        } elseif ($request->type === 'claim') {
            $additionalData = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
                // 'birthday' => Auth::user()->birthday ? Auth::user()->birthday->format('Y-m-d') : null,
                 'date_of_birth' => $request->date_of_birth,
                'certify_info' => $request->certify_info,
                'agree_terms' => $request->agree_terms,
            ];
        }

        // Handle file uploads
        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('requests', 'public');
                $photoPaths[] = $path;
            }
        }

        // Create the request
        $petRequest = $pet->requests()->create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'reason' => $request->reason ?? $request->proof_of_ownership_description ?? '',
            'contact_info' => $request->contact_number ?? $request->contact_info ?? '',
            'photos' => json_encode($photoPaths), // Store as JSON array
            'additional_data' => json_encode($additionalData),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }
}
