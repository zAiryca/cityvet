<?php

namespace App\Http\Controllers;

use App\Models\PetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetRequestController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $requestStatus = request('status', 'pending'); // Default to pending
        $type = request('type');

        // Fetch all pets that have requests with the specified status
        $petsQuery = Pet::whereHas('requests', function ($q) use ($requestStatus, $type) {
            $q->where('status', $requestStatus);
            if ($type) {
                $q->where('type', $type);
            }
        });

        // For approved requests, only show pets that are adoptable or impounded
        if ($requestStatus === 'approved') {
            $petsQuery->whereIn('status', ['adoptable', 'impounded']);
        }

        $petsQuery = $petsQuery->with([

            'requests' => function ($q) use ($requestStatus, $type) {
                $q->where('status', $requestStatus);
                if ($type) {
                    $q->where('type', $type);
                }
                $q->orderBy('created_at', 'desc');
            },
            'requests.user',
        ])
        ->orderBy('updated_at', 'desc');

        $pets = $petsQuery->paginate(10)->appends(request()->query());

        // Count requests by status for tabs
        $pendingCount = Pet::whereHas('requests', function ($q) {
            $q->where('status', 'pending');
        })->count();

        $approvedCount = Pet::whereHas('requests', function ($q) {
            $q->where('status', 'approved');
        })->count();

        $deniedCount = Pet::whereHas('requests', function ($q) {
            $q->where('status', 'denied');
        })->count();

        return view('admin.requests.index', compact('pets', 'requestStatus', 'pendingCount', 'approvedCount', 'deniedCount'));
    }

    public function show(PetRequest $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.requests.show', compact('request'));
    }

    public function update(Request $request, PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $status = $request->status;  // 'approved', 'denied', or 'pending'
        $adminNotes = $request->admin_notes ?? null;

        $petRequest->update([
            'status' => $status,
            'admin_notes' => $adminNotes
        ]);

        // Send notification to the user only if status changed to approved or denied
        if ($status === 'approved' || $status === 'denied') {
            if ($petRequest->user) {
                $petRequest->user->notify(new \App\Notifications\RequestStatusNotification($petRequest, $status));
            }
        }

        return redirect()->back()->with('success', 'Request ' . $status . '.');
    }

    public function approve(PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $petRequest->update(['status' => 'approved']);

        // Note: Pet status is NOT changed here. Only "Mark as Adopted" or "Mark as Claimed" buttons in admin pets section will change pet status
        // This approval just means the request is approved, but the user still needs to complete the process at the vet

        if ($petRequest->user) {
            $petRequest->user->notify(new \App\Notifications\RequestStatusNotification($petRequest, 'approved'));
        }

        return redirect()->route('admin.requests.index', ['status' => 'approved'])->with('success', 'Request approved.');
    }

    public function deny(PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $petRequest->update(['status' => 'denied']);

        if ($petRequest->user) {
            $petRequest->user->notify(new \App\Notifications\RequestStatusNotification($petRequest, 'denied'));
        }

        return redirect()->route('admin.requests.index', ['status' => 'denied'])->with('success', 'Request denied.');
    }


    // Finalize adoption or claim (set request to completed and update pet ownership)
    public function finalize(PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        // Only allow finalizing approved requests
        if ($petRequest->status !== 'approved') {
            return back()->with('error', 'Only approved requests can be finalized.');
        }

        $pet = $petRequest->requestable;
        if (!$pet || !($pet instanceof Pet)) {
            return back()->with('error', 'Invalid request or pet not found.');
        }

        // Determine final status based on request type
        $finalStatus = $petRequest->type === 'claim' ? 'claimed' : 'adopted';

        try {
            // Update pet: transfer ownership and set status to adopted/claimed
            // This ensures the pet appears in the user's adopted-claimed-pets page
            $pet->update([
                'user_id' => $petRequest->user_id,
                'status' => $finalStatus,
            ]);

            // Update request status to completed (use `updated_at` for timestamp tracking)
            $petRequest->update(['status' => 'completed']);

            // Notify requester
            if ($petRequest->user) {
                $petRequest->user->notify(new \App\Notifications\RequestStatusNotification($petRequest, 'completed'));
            }

            return redirect()->route('admin.requests.index', ['status' => 'approved'])->with('success', 'Pet ' . ucfirst($finalStatus) . ' (ID: ' . $pet->display_code . ') and ownership transferred to ' . $petRequest->user->name . ' successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to finalize request: ' . $e->getMessage());
        }
    }

    public function destroy(PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $petRequest->delete();

        return redirect()->route('admin.requests.index')->with('success', 'Request deleted successfully.');
    }
}
