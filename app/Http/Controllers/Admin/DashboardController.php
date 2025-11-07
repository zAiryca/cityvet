<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\PetRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pets' => Pet::count(),
            'impounded' => Pet::where('status', 'impounded')->count(),
            'adoptable' => Pet::where('status', 'adoptable')->count(),
            'pending_posters' => Poster::where('approved', 0)->count(),
            'pending_requests' => PetRequest::where('status', 'pending')->count(),
            'total_events' => Event::count(),
            'approved_posters' => Poster::where('approved', 1)->count(),
            'approved_adoptions' => PetRequest::where('type', 'adopt')->where('status', 'approved')->count(),
            'pre_registered_pets' => Pet::where('registration_status', 'pre-registered')->count(),
        ];

        $recentPets = Pet::orderBy('created_at', 'desc')->limit(5)->get();

        $upcomingEvents = Event::upcoming()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPets', 'upcomingEvents'));
    }
}
