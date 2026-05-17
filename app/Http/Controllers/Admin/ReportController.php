<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\PetRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use DateTime;

class ReportController extends Controller
{
    /**
     * Build comprehensive pet lifecycle data array
     */
    private function buildPetLifecycleData(Pet $pet): array
    {
        // Get transition dates from completed requests
        $claimRequest = $pet->requests->where('status', 'completed')
            ->where('type', 'claim')
            ->sortByDesc('updated_at')
            ->first();

        $adoptRequest = $pet->requests->where('status', 'completed')
            ->where('type', 'adopt')
            ->sortByDesc('updated_at')
            ->first();

        // Determine adoptable date
        $adoptableDate = null;
        if ($pet->decision_date) {
            // Transitioned from impounded to adoptable
            $adoptableDate = $pet->decision_date;
        } elseif (!$pet->impounded_date && $pet->status === 'adoptable') {
            // Direct adoptable entry - use created date
            $adoptableDate = $pet->created_at;
        }

        return [
            'id' => $pet->id,
            'code' => $pet->display_code,
            'species' => $pet->species,
            'breed' => $pet->breed ?: 'Unknown',
            'gender' => $pet->gender ?: 'Unknown',
            'markings' => $pet->color_markings ?: 'N/A',
            'impounded_date' => $pet->impounded_date,
            'adoptable_date' => $adoptableDate,
            'claimed_date' => $claimRequest ? $claimRequest->updated_at : null,
            'adopted_date' => $adoptRequest ? $adoptRequest->updated_at : null,
            'current_status' => $pet->status,
        ];
    }

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
            'report_scope' => 'nullable|in:impounded,adoptable,adopted,claimed,all',
        ]);

        $month = (int) $validated['month'];
        $year = (int) $validated['year'];
        $scope = $validated['report_scope'] ?? 'impounded';

        // Build comprehensive pet lifecycle data based on scope
        $petsData = collect();

        switch ($scope) {
            case 'impounded':
                // Pets that entered through impound this month
                $petsData = Pet::whereYear('impounded_date', $year)
                    ->whereMonth('impounded_date', $month)
                    ->with('requests')
                    ->get()
                    ->map(function ($pet) {
                        return $this->buildPetLifecycleData($pet);
                    });
                break;

            case 'adoptable':
                // Pets that became adoptable this month (either impounded→adoptable transition or direct entry)
                $petsData = Pet::where(function ($query) use ($year, $month) {
                    // Direct adoptable entries (no impound date)
                    $query->whereNull('impounded_date')
                          ->whereYear('created_at', $year)
                          ->whereMonth('created_at', $month)
                          ->where('status', 'adoptable');
                })->orWhere(function ($query) use ($year, $month) {
                    // Transitioned to adoptable this month
                    $query->whereYear('decision_date', $year)
                          ->whereMonth('decision_date', $month);
                })->with('requests')->get()
                  ->map(function ($pet) {
                      return $this->buildPetLifecycleData($pet);
                  });
                break;

            case 'adopted':
                // Pets adopted this month
                $adoptRequests = PetRequest::where('type', 'adopt')
                    ->where('status', 'completed')
                    ->whereYear('updated_at', $year)
                    ->whereMonth('updated_at', $month)
                    ->with('requestable')
                    ->get();

                $petsData = $adoptRequests->map(function ($req) {
                    $pet = $req->requestable;
                    if ($pet instanceof Pet) {
                        $data = $this->buildPetLifecycleData($pet);
                        $data['adopted_date'] = $req->updated_at;
                        return $data;
                    }
                    return null;
                })->filter()->unique('id')->values();
                break;

            case 'claimed':
                // Pets claimed this month
                $claimRequests = PetRequest::where('type', 'claim')
                    ->where('status', 'completed')
                    ->whereYear('updated_at', $year)
                    ->whereMonth('updated_at', $month)
                    ->with('requestable')
                    ->get();

                $petsData = $claimRequests->map(function ($req) {
                    $pet = $req->requestable;
                    if ($pet instanceof Pet) {
                        $data = $this->buildPetLifecycleData($pet);
                        $data['claimed_date'] = $req->updated_at;
                        return $data;
                    }
                    return null;
                })->filter()->unique('id')->values();
                break;

            case 'all':
            default:
                // Complete monthly activity - combine all pets that had any activity this month
                $allPets = collect();

                // Add impounded pets
                $impounded = Pet::whereYear('impounded_date', $year)
                    ->whereMonth('impounded_date', $month)
                    ->with('requests')->get();
                $allPets = $allPets->merge($impounded);

                // Add adoptable pets
                $adoptable = Pet::where(function ($query) use ($year, $month) {
                    $query->whereNull('impounded_date')
                          ->whereYear('created_at', $year)
                          ->whereMonth('created_at', $month)
                          ->where('status', 'adoptable');
                })->orWhere(function ($query) use ($year, $month) {
                    $query->whereYear('decision_date', $year)
                          ->whereMonth('decision_date', $month);
                })->with('requests')->get();
                $allPets = $allPets->merge($adoptable);

                // Add adopted pets
                $adoptedReqs = PetRequest::where('type', 'adopt')
                    ->where('status', 'completed')
                    ->whereYear('updated_at', $year)
                    ->whereMonth('updated_at', $month)
                    ->with('requestable')
                    ->get();
                $adoptedPets = $adoptedReqs->map(fn($req) => $req->requestable instanceof Pet ? $req->requestable : null)->filter();
                $allPets = $allPets->merge($adoptedPets);

                // Add claimed pets
                $claimedReqs = PetRequest::where('type', 'claim')
                    ->where('status', 'completed')
                    ->whereYear('updated_at', $year)
                    ->whereMonth('updated_at', $month)
                    ->with('requestable')
                    ->get();
                $claimedPets = $claimedReqs->map(fn($req) => $req->requestable instanceof Pet ? $req->requestable : null)->filter();
                $allPets = $allPets->merge($claimedPets);

                // Build lifecycle data and remove duplicates
                $petsData = $allPets->unique('id')->map(function ($pet) {
                    return $this->buildPetLifecycleData($pet);
                });
                break;
        }

        // Calculate summary counts from report data (historical data for the selected period)
        $summaryCounts = [
            'total_records' => $petsData->count(),
            'impounded' => $petsData->whereNotNull('impounded_date')->count(),
            'adoptable' => $petsData->whereNotNull('adoptable_date')->count(), // All adoptable pets (direct + transitioned)
            'claimed' => $petsData->whereNotNull('claimed_date')->count(),
            'adopted' => $petsData->whereNotNull('adopted_date')->count(),
        ];

        $data = [
            'petsData' => $petsData,
            'month' => $month,
            'year' => $year,
            'report_scope' => $scope,
            'summaryCounts' => $summaryCounts,
            'totalPets' => $petsData->count(),
        ];

        if ($validated['format'] === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.pets_monthly', $data)
                ->setPaper('a4', 'landscape');
            $fileName = sprintf('monthly-report-%d-%02d.pdf', $year, $month);
            return $pdf->download($fileName);
        }

        // CSV export using new data structure with aligned columns
        $callback = function () use ($petsData, $scope, $month, $year, $summaryCounts) {
            $handle = fopen('php://output', 'w');

            // Prepare data for column width calculation
            $headers = ['Code', 'Species', 'Breed', 'Gender', 'Markings', 'Impounded Date', 'Adoptable Date', 'Claimed Date', 'Adopted Date'];
            $allRows = [$headers];

            foreach ($petsData as $pet) {
                $allRows[] = [
                    $pet['code'],
                    $pet['species'],
                    $pet['breed'],
                    $pet['gender'],
                    $pet['markings'],
                    $pet['impounded_date'] ? $pet['impounded_date']->format('M d, Y') : '',
                    $pet['adoptable_date'] ? $pet['adoptable_date']->format('M d, Y') : '',
                    $pet['claimed_date'] ? $pet['claimed_date']->format('M d, Y') : '',
                    $pet['adopted_date'] ? $pet['adopted_date']->format('M d, Y') : '',
                ];
            }

            // Calculate maximum width for each column
            $columnWidths = [];
            foreach ($headers as $index => $header) {
                $maxWidth = strlen($header);
                foreach ($allRows as $row) {
                    $maxWidth = max($maxWidth, strlen($row[$index]));
                }
                $columnWidths[$index] = $maxWidth;
            }

            // Write aligned header
            $alignedHeaders = [];
            foreach ($headers as $index => $header) {
                $alignedHeaders[] = str_pad($header, $columnWidths[$index]);
            }
            fputcsv($handle, $alignedHeaders);

            // Write aligned data rows
            foreach ($petsData as $pet) {
                $row = [
                    $pet['code'],
                    $pet['species'],
                    $pet['breed'],
                    $pet['gender'],
                    $pet['markings'],
                    $pet['impounded_date'] ? $pet['impounded_date']->format('M d, Y') : '',
                    $pet['adoptable_date'] ? $pet['adoptable_date']->format('M d, Y') : '',
                    $pet['claimed_date'] ? $pet['claimed_date']->format('M d, Y') : '',
                    $pet['adopted_date'] ? $pet['adopted_date']->format('M d, Y') : '',
                ];

                $alignedRow = [];
                foreach ($row as $index => $value) {
                    $alignedRow[] = str_pad($value, $columnWidths[$index]);
                }
                fputcsv($handle, $alignedRow);
            }

            // Scope-aware Monthly Activity Summary (matching PDF format)
            fputcsv($handle, ['']);

            if ($scope === 'impounded') {
                fputcsv($handle, ['Monthly Activity Summary: Total Records ' . $summaryCounts['total_records'] . ', Impounded ' . $summaryCounts['impounded']]);
            } elseif ($scope === 'adoptable') {
                fputcsv($handle, ['Monthly Activity Summary: Total Records ' . $summaryCounts['total_records'] . ', Impounded ' . $summaryCounts['impounded'] . ', Adoptable ' . $summaryCounts['adoptable']]);
            } elseif ($scope === 'claimed') {
                fputcsv($handle, ['Monthly Activity Summary: Total Records ' . $summaryCounts['total_records'] . ', Impounded ' . $summaryCounts['impounded'] . ', Adoptable ' . $summaryCounts['adoptable'] . ', Claimed ' . $summaryCounts['claimed']]);
            } elseif ($scope === 'adopted') {
                fputcsv($handle, ['Monthly Activity Summary: Total Records ' . $summaryCounts['total_records'] . ', Impounded ' . $summaryCounts['impounded'] . ', Adoptable ' . $summaryCounts['adoptable'] . ', Adopted ' . $summaryCounts['adopted']]);
            } else {
                fputcsv($handle, ['Monthly Activity Summary: Total Records ' . $summaryCounts['total_records'] . ', Impounded ' . $summaryCounts['impounded'] . ', Adoptable ' . $summaryCounts['adoptable'] . ', Claimed ' . $summaryCounts['claimed'] . ', Adopted ' . $summaryCounts['adopted']]);
            }

            fclose($handle);
        };

        $fileName = sprintf('monthly-report-%d-%02d.csv', $year, $month);
        return response()->streamDownload($callback, $fileName, [
            'Content-Type' => 'text/csv',
        ]);
    }
}
