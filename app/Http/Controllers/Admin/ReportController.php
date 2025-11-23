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

        return view('admin.reports.generate');
    }

    public function export(Request $request)
    {
        if (!auth()->user()->isAdmin()) abort(403);

        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'format' => 'required|in:pdf,csv',
            'report_scope' => 'nullable|in:impounded,claimed,adopted,all',
        ]);

        $month = (int) $validated['month'];
        $year = (int) $validated['year'];

        $scope = $validated['report_scope'] ?? 'impounded';

        // Query impounded pets for the month (used for impounded scope and summary)
        $impoundedPets = collect();
        if (in_array($scope, ['impounded', 'all'])) {
            $impoundedPets = Pet::whereYear('impounded_date', $year)
                ->whereMonth('impounded_date', $month)
                ->with('requests')
                ->orderBy('impounded_date', 'desc')
                ->get();
        }

        // Totals / summary
        $impoundedCount = $impoundedPets->count();

        // Current totals in DB (kept for informational / backward compatibility)
        $currentImpoundedTotal = Pet::where('status', 'impounded')->count();
        $currentAdoptableTotal = Pet::where('status', 'adoptable')->count();

        // For each impounded pet, determine Adopted Date and Claimed Date from completed requests
        foreach ($impoundedPets as $pet) {
            $completedAdopt = $pet->requests->where('status', 'completed')
                ->where('type', 'adopt')
                ->sortByDesc('updated_at')
                ->first();
            $completedClaim = $pet->requests->where('status', 'completed')
                ->where('type', 'claim')
                ->sortByDesc('updated_at')
                ->first();

            $pet->adopted_date = $completedAdopt ? $completedAdopt->updated_at : null;
            $pet->claimed_date = $completedClaim ? $completedClaim->updated_at : null;
        }

        // Claimed pets (based on completed claim requests in the month)
        $claimedPets = collect();
        if (in_array($scope, ['claimed', 'all'])) {
            $claimRequests = PetRequest::where('type', 'claim')
                ->where('status', 'completed')
                ->whereYear('updated_at', $year)
                ->whereMonth('updated_at', $month)
                ->with('requestable')
                ->get();

            // Map to pets (requestable could be other models, ensure it is Pet)
            $claimedPets = $claimRequests->map(function ($req) {
                $pet = $req->requestable;
                if ($pet instanceof Pet) {
                    $pet->claimed_date = $req->updated_at;
                    return $pet;
                }
                return null;
            })->filter()->unique('id')->values();
        }

        // Adopted pets (based on completed adopt requests in the month)
        $adoptedPets = collect();
        if (in_array($scope, ['adopted', 'all'])) {
            $adoptRequests = PetRequest::where('type', 'adopt')
                ->where('status', 'completed')
                ->whereYear('updated_at', $year)
                ->whereMonth('updated_at', $month)
                ->with('requestable')
                ->get();

            $adoptedPets = $adoptRequests->map(function ($req) {
                $pet = $req->requestable;
                if ($pet instanceof Pet) {
                    $pet->adopted_date = $req->updated_at;
                    return $pet;
                }
                return null;
            })->filter()->unique('id')->values();
        }

        // Counts for the month
        $adoptedCount = $adoptedPets->count() ?: $impoundedPets->filter(fn($p) => !is_null($p->adopted_date))->count();
        $claimedCount = $claimedPets->count() ?: $impoundedPets->filter(fn($p) => !is_null($p->claimed_date))->count();

        $data = [
            'impoundedPets' => $impoundedPets,
            'claimedPets' => $claimedPets,
            'adoptedPets' => $adoptedPets,
            'month' => $month,
            'year' => $year,
            'impoundedCount' => $impoundedCount,
            'currentImpoundedTotal' => $currentImpoundedTotal,
            'currentAdoptableTotal' => $currentAdoptableTotal,
            'adoptedCount' => $adoptedCount,
            'claimedCount' => $claimedCount,
            'report_scope' => $scope,
        ];

        if ($validated['format'] === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.pets_monthly', $data);
            $fileName = sprintf('pets-report-%d-%02d.pdf', $year, $month);
            return $pdf->download($fileName);
        }

        // CSV export: behave according to selected scope
        $callback = function () use ($impoundedPets, $claimedPets, $adoptedPets, $impoundedCount, $claimedCount, $adoptedCount, $scope) {
            $handle = fopen('php://output', 'w');

            if ($scope === 'claimed') {
                fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Color/markings', 'Impounded Date', 'Claimed Date']);
                $i = 1;
                foreach ($claimedPets as $pet) {
                    fputcsv($handle, [
                        $i++,
                        $pet->display_code,
                        $pet->species,
                        $pet->breed,
                        $pet->color_markings ?? '',
                        $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                        $pet->claimed_date ? $pet->claimed_date->toDateString() : '',
                    ]);
                }
            } elseif ($scope === 'adopted') {
                fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Color/markings', 'Impounded Date', 'Adoptable Date', 'Adopted Date']);
                $i = 1;
                foreach ($adoptedPets as $pet) {
                    // adoptable date: if pet has no impounded_date, show created_at as adoptable created
                    $adoptable = (!$pet->impounded_date) ? $pet->created_at : null;
                    fputcsv($handle, [
                        $i++,
                        $pet->display_code,
                        $pet->species,
                        $pet->breed,
                        $pet->color_markings ?? '',
                        $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                        $adoptable ? $adoptable->toDateString() : '',
                        $pet->adopted_date ? $pet->adopted_date->toDateString() : '',
                    ]);
                }
            } else {
                // default / impounded or all -> export impounded dataset first
                fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Color/markings', 'Impounded Date', 'Claimed Date', 'Adopted Date']);
                $i = 1;
                foreach ($impoundedPets as $pet) {
                    fputcsv($handle, [
                        $i++,
                        $pet->display_code,
                        $pet->species,
                        $pet->breed,
                        $pet->color_markings ?? '',
                        $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                        $pet->claimed_date ? $pet->claimed_date->toDateString() : '',
                        $pet->adopted_date ? $pet->adopted_date->toDateString() : '',
                    ]);
                }

                // If scope is 'all', also append claimed and adopted tables (separated)
                if ($scope === 'all') {
                    fputcsv($handle, []);
                    fputcsv($handle, ['Claimed Pets']);
                    fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Color/markings', 'Impounded Date', 'Claimed Date']);
                    $i = 1;
                    foreach ($claimedPets as $pet) {
                        fputcsv($handle, [
                            $i++,
                            $pet->display_code,
                            $pet->species,
                            $pet->breed,
                            $pet->color_markings ?? '',
                            $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                            $pet->claimed_date ? $pet->claimed_date->toDateString() : '',
                        ]);
                    }

                    fputcsv($handle, []);
                    fputcsv($handle, ['Adopted Pets']);
                    fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Color/markings', 'Impounded Date', 'Adoptable Date', 'Adopted Date']);
                    $i = 1;
                    foreach ($adoptedPets as $pet) {
                        $adoptable = (!$pet->impounded_date) ? $pet->created_at : null;
                        fputcsv($handle, [
                            $i++,
                            $pet->display_code,
                            $pet->species,
                            $pet->breed,
                            $pet->color_markings ?? '',
                            $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                            $adoptable ? $adoptable->toDateString() : '',
                            $pet->adopted_date ? $pet->adopted_date->toDateString() : '',
                        ]);
                    }
                }
            }

            // Blank line then summary
            fputcsv($handle, []);
            fputcsv($handle, ['Summary', 'Metric', 'Value']);
            fputcsv($handle, ['', 'Impounded this month', $impoundedCount]);
            fputcsv($handle, ['', 'Claimed this month', $claimedCount]);
            fputcsv($handle, ['', 'Adopted this month', $adoptedCount]);

            fclose($handle);
        };

        $fileName = sprintf('pets-report-%d-%02d.csv', $year, $month);
        return response()->streamDownload($callback, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
