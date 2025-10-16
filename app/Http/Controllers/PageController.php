<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');  // Includes location, FAQ, donate sections
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function location()
    {
        return view('pages.location');
    }

    public function donate()
    {
        return view('pages.donate');
    }
}
