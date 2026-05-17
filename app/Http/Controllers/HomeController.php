<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Poster;
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $impounded = Pet::where('status', 'impounded')->latest()->take(4)->get();
        $adoptable = Pet::where('status', 'adoptable')->latest()->take(4)->get();
        $posters = Poster::where('approved', true)->latest()->take(4)->get();
        $announcements = Announcement::latest()->take(5)->get();

        return view('home', compact('impounded', 'adoptable', 'posters', 'announcements'));
    }
}
