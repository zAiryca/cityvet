<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\Event;
use App\Models\PetRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate()
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = [
            'total_pets' => Pet::count(),
            'impounded' => Pet::where('status', 'impounded')->count(),
            'adoptable' => Pet::where('status', 'adoptable')->count(),
            'adopted' => Pet::where('status', 'adopted')->count(),
            'lost_found' => Poster::where('approved', true)->count(),
            'events' => Event::count(),
            'adoptions' => PetRequest::where('type', 'adopt')->where('status', 'approved')->count(),
            'claims' => PetRequest::where('type', 'claim')->where('status', 'approved')->count(),
            'recent_pets' => Pet::latest()->take(3)->get(),
            'recent_events' => Event::latest()->take(3)->get(),
        ];

        $pdf = Pdf::loadView('admin.reports.summary', $data);
        return $pdf->download('cityvet-report.pdf');
    }
}
