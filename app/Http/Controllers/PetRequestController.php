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

        $query = PetRequest::with(['requestable', 'user']);

        // Apply filters
        if (request('status')) {
            $query->where('status', request('status'));
        }
        if (request('type')) {
            $query->where('type', request('type'));
        }
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('first_name', 'like', "%{$search}%")
                              ->orWhere('last_name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('requestable', function ($requestableQuery) use ($search) {
                    $requestableQuery->where('name', 'like', "%{$search}%") // For pets
                                     ->orWhere('title', 'like', "%{$search}%"); // For events
                });
            });
        }

        $requests = $query->paginate(10)->appends(request()->query());

        return view('admin.requests.index', compact('requests'));
    }

    public function update(Request $request, PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $status = $request->status;  // 'approved' or 'denied'
        $petRequest->update(['status' => $status]);

        if ($status === 'approved') {
            $pet = $petRequest->requestable; // Use polymorphic relationship
            if ($petRequest->type === 'claim') {
                $pet->update(['status' => 'claimed', 'user_id' => $petRequest->user_id]);
            } elseif ($petRequest->type === 'adopt') {
                $pet->update(['status' => 'adopted', 'user_id' => $petRequest->user_id, 'urgent_deadline' => null]);
            }
        }

        // Send notification to the user
        $petRequest->user->notify(new \App\Notifications\RequestStatusNotification($petRequest, $status));

        return back()->with('success', 'Request ' . $status . '.');
    }
}
