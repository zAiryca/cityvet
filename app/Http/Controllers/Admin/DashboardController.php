<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\Event;
use App\Models\PetRequest;

class DashboardController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $stats = [
            'total_pets' => Pet::count(),
            'impounded' => Pet::where('status', 'impounded')->count(),
            'adoptable' => Pet::where('status', 'adoptable')->count(),
            'pending_requests' => PetRequest::where('status', 'pending')->count(),
            'events' => Event::count(),
            'posters' => Poster::where('approved', true)->count(),
            'adoptions' => PetRequest::where('type', 'adopt')->where('status', 'approved')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
