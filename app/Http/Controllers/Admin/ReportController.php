<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\Announcement;
use App\Models\PetRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate()
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $data = [

        ];

        $pdf = Pdf::loadView('admin.reports.summary', $data);
        return $pdf->download('cityvet-report.pdf');
    }
}
