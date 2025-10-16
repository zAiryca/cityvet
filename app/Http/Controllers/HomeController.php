<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Poster;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $impounded = Pet::where('status', 'impounded')->latest()->take(3)->get();
        $adoptable = Pet::where('status', 'adoptable')->latest()->take(3)->get();

        // FIXED: Use 'event_date' instead of 'date' for the correct column
        $upcomingEvents = Event::where('event_date', '>=', now())
                               ->orderBy('event_date')  // Defaults to 'asc' for upcoming events
                               ->limit(3)
                               ->get();

        $posters = Poster::where('approved', true)->latest()->take(3)->get();

        // FIXED: Compact 'upcomingEvents' instead of 'events' to match the variable
        return view('home', compact('impounded', 'adoptable', 'upcomingEvents', 'posters'));
    }
}
