<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        // Require type early so validation branches are reliable
        $request->validate([
            'type' => 'required|in:adopt,claim',
        ]);
        // Log incoming request for easier debugging (non-sensitive subset)
        Log::info('PetController::request - incoming', [
            'user_id' => Auth::id(),
            'pet_id' => $pet->id ?? null,
            'route_type' => $request->input('type'),
            'has_proof_of_ownership_description' => $request->has('proof_of_ownership_description'),
            'has_photos' => $request->hasFile('photos'),
        ]);

        // Check if user already has a pending/approved request for this pet
        $existingRequest = $pet->requests()
            ->where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You already have a ' . $existingRequest->status . ' request for this pet. Please wait for admin review.');
        }

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
                'first_name' => $request->first_name ?? Auth::user()->first_name ?? null,
                'last_name' => $request->last_name ?? Auth::user()->last_name ?? null,
                'middle_name' => $request->middle_name ?? Auth::user()->middle_name ?? null,
                'address' => $request->address ?? trim((Auth::user()->street ?? '') . ', ' . (Auth::user()->barangay ?? '') . ', ' . (Auth::user()->city_municipality ?? '')),
                'contact_number' => $request->contact_number ?? Auth::user()->contact_number ?? null,
                'email' => $request->email ?? Auth::user()->email ?? null,
                // Prefer explicit form value, fall back to user's profile birthday
                'date_of_birth' => $request->date_of_birth ?? (Auth::user()->birthday ? Auth::user()->birthday->format('Y-m-d') : null),
                'dwelling_type' => $request->dwelling_type ?? null,
                'landlord_permission' => $request->landlord_permission ?? null,
                'fenced_property' => $request->fenced_property ?? null,
                'adults_count' => $request->adults_count ?? null,
                'children_count' => $request->children_count ?? null,
                'allergies' => $request->allergies ?? null,
                'other_pets' => $request->other_pets ?? null,
                'other_pets_list' => $request->other_pets_list ?? null,
                'pet_living_area' => $request->pet_living_area ?? null,
                'certify_info' => $request->certify_info ?? null,
                'agree_terms' => $request->agree_terms ?? null,
                // include user id photo path (from hidden form input or profile)
                'id_photo_path' => $request->id_photo_path ?? Auth::user()->id_photo ?? null,
            ];
        } elseif ($request->type === 'claim') {
            $additionalData = [
                'first_name' => $request->first_name ?? Auth::user()->first_name ?? null,
                'last_name' => $request->last_name ?? Auth::user()->last_name ?? null,
                'middle_name' => $request->middle_name ?? Auth::user()->middle_name ?? null,
                'address' => $request->address ?? trim((Auth::user()->street ?? '') . ', ' . (Auth::user()->barangay ?? '') . ', ' . (Auth::user()->city_municipality ?? '')),
                'contact_number' => $request->contact_number ?? Auth::user()->contact_number ?? null,
                'email' => $request->email ?? Auth::user()->email ?? null,
                // prefer form value, otherwise use profile birthday
                'date_of_birth' => $request->date_of_birth ?? (Auth::user()->birthday ? Auth::user()->birthday->format('Y-m-d') : null),
                'certify_info' => $request->certify_info ?? null,
                'agree_terms' => $request->agree_terms ?? null,
                // include id photo path for claim verification
                'id_photo_path' => $request->id_photo_path ?? Auth::user()->id_photo ?? null,
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

        // Normalize additional data: ensure keys exist so stored JSON is self-contained
        $additionalData['date_of_birth'] = $additionalData['date_of_birth'] ?? (Auth::user()->birthday ? Auth::user()->birthday->format('Y-m-d') : null);
        $additionalData['id_photo_path'] = $additionalData['id_photo_path'] ?? (Auth::user()->id_photo ?? null);

        // Create the request (store arrays — the model casts will handle JSON)
        $petRequest = $pet->requests()->create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'reason' => $request->reason ?? $request->proof_of_ownership_description ?? '',
            'contact_info' => $request->contact_number ?? $request->contact_info ?? '',
            'photos' => $photoPaths,
            'additional_data' => $additionalData,
            'status' => 'pending',
        ]);

        Log::info('PetController::request - created pet_request', [
            'pet_request_id' => $petRequest->id ?? null,
            'user_id' => $petRequest->user_id ?? Auth::id(),
            'pet_id' => $pet->id ?? null,
            'type' => $petRequest->type ?? $request->type,
            'status' => $petRequest->status ?? 'pending',
        ]);

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }
}
