<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Poster;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $impounded = Pet::where('status', 'impounded')->latest()->take(3)->get();
        $adoptable = Pet::where('status', 'adoptable')->latest()->take(3)->get();
        $posters = Poster::where('approved', true)->latest()->take(3)->get();

        return view('home', compact('impounded', 'adoptable', 'posters'));
    }
}
