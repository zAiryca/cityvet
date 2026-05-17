<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateReportSample extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:report-sample {--month= : Month number (1-12)} {--year= : Year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sample pets monthly report PDF and CSV for a given month/year and save to storage/app/reports';

    public function handle()
    {
        $month = (int) $this->option('month') ?: (int)date('n');
        $year = (int) $this->option('year') ?: (int)date('Y');

        $this->info("Generating comprehensive report for $year-$month ...");

        // Get all pets that were created in this month, regardless of current status
        $petsThisMonth = Pet::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->with('requests')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get transition data for each pet (accounting for automatic transitions)
        foreach ($petsThisMonth as $pet) {
            $completedRequests = $pet->requests->where('status', 'completed')
                ->whereIn('type', ['adopt', 'claim'])
                ->sortByDesc('updated_at');

            $pet->completed_requests = $completedRequests;
            $pet->latest_completion = $completedRequests->first();

            // Determine transition dates based on status changes and automatic transitions
            $transition_date = null;
            if ($pet->latest_completion) {
                $transition_date = $pet->latest_completion->updated_at;
            } elseif ($pet->status === 'adoptable' && $pet->impounded_date) {
                // Automatically transitioned from impounded to adoptable
                $transition_date = $pet->impounded_date->copy()->addDays(3);
            } elseif ($pet->status === 'unadopted' && $pet->decision_date) {
                // Automatically transitioned from adoptable to unadopted
                $transition_date = $pet->decision_date->copy()->addDays(4);
            } elseif ($pet->status === 'unadopted' && $pet->impounded_date && !$pet->decision_date) {
                // Directly to unadopted (no adoptable phase)
                $transition_date = $pet->impounded_date->copy()->addDays(7);
            }

            $pet->transition_date = $transition_date;
            $pet->final_status = $pet->status; // Current status at time of report
        }

        // Statistics
        $totalPetsAdded = $petsThisMonth->count();
        $currentImpoundedTotal = Pet::where('status', 'impounded')->count();
        $currentAdoptableTotal = Pet::where('status', 'adoptable')->count();
        $currentAdoptedTotal = Pet::where('status', 'adopted')->count();
        $currentClaimedTotal = Pet::where('status', 'claimed')->count();
        $currentUnclaimedTotal = Pet::where('status', 'unclaimed')->count();
        $currentUnadoptedTotal = Pet::where('status', 'unadopted')->count();

        // Monthly outcomes
        $adoptedThisMonth = $petsThisMonth->filter(fn($p) => $p->final_status === 'adopted')->count();
        $claimedThisMonth = $petsThisMonth->filter(fn($p) => $p->final_status === 'claimed')->count();
        $unclaimedThisMonth = $petsThisMonth->filter(fn($p) => $p->final_status === 'unclaimed')->count();
        $unadoptedThisMonth = $petsThisMonth->filter(fn($p) => $p->final_status === 'unadopted')->count();
        $stillActiveThisMonth = $petsThisMonth->filter(fn($p) => in_array($p->final_status, ['impounded', 'adoptable']))->count();

        $data = [
            'petsThisMonth' => $petsThisMonth,
            'month' => $month,
            'year' => $year,
            'totalPetsAdded' => $totalPetsAdded,
            'currentImpoundedTotal' => $currentImpoundedTotal,
            'currentAdoptableTotal' => $currentAdoptableTotal,
            'currentAdoptedTotal' => $currentAdoptedTotal,
            'currentClaimedTotal' => $currentClaimedTotal,
            'currentUnclaimedTotal' => $currentUnclaimedTotal,
            'currentUnadoptedTotal' => $currentUnadoptedTotal,
            'adoptedThisMonth' => $adoptedThisMonth,
            'claimedThisMonth' => $claimedThisMonth,
            'unclaimedThisMonth' => $unclaimedThisMonth,
            'unadoptedThisMonth' => $unadoptedThisMonth,
            'stillActiveThisMonth' => $stillActiveThisMonth,
        ];

        // Ensure directory
        $dir = storage_path('app/reports');
        if (!file_exists($dir)) mkdir($dir, 0755, true);

        // PDF
        try {
            $pdf = Pdf::loadView('admin.reports.pets_monthly', $data);
            $pdfPath = $dir . DIRECTORY_SEPARATOR . sprintf('pets-report-%d-%02d.pdf', $year, $month);
            $pdf->save($pdfPath);
            $this->info("Saved PDF to: $pdfPath");
        } catch (\Exception $e) {
            $this->error('PDF generation failed: ' . $e->getMessage());
        }

        // CSV
        $csvPath = $dir . DIRECTORY_SEPARATOR . sprintf('pets-report-%d-%02d.csv', $year, $month);
        $handle = fopen($csvPath, 'w');
        fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Current Status', 'Created Date', 'Transition Date', 'Final Status']);
        $i = 1;
        foreach ($petsThisMonth as $pet) {
            fputcsv($handle, [
                $i++,
                $pet->display_code,
                $pet->species,
                $pet->breed ?: 'Unknown',
                $pet->status,
                $pet->created_at ? $pet->created_at->toDateString() : '',
                $pet->transition_date ? $pet->transition_date->toDateString() : '',
                $pet->final_status,
            ]);
        }

        // Summary rows
        fputcsv($handle, []);
        fputcsv($handle, ['Summary', 'Metric', 'Value']);
        fputcsv($handle, ['', 'Total Pets Added', $totalPetsAdded]);
        fputcsv($handle, ['', 'Adopted', $adoptedThisMonth]);
        fputcsv($handle, ['', 'Claimed', $claimedThisMonth]);
        fputcsv($handle, ['', 'Unclaimed', $unclaimedThisMonth]);
        fputcsv($handle, ['', 'Unadopted', $unadoptedThisMonth]);
        fputcsv($handle, ['', 'Still Active', $stillActiveThisMonth]);
        fputcsv($handle, []);
        fputcsv($handle, ['Current System Totals', '', '']);
        fputcsv($handle, ['', 'Impounded', $currentImpoundedTotal]);
        fputcsv($handle, ['', 'Adoptable', $currentAdoptableTotal]);
        fputcsv($handle, ['', 'Adopted', $currentAdoptedTotal]);
        fputcsv($handle, ['', 'Claimed', $currentClaimedTotal]);
        fputcsv($handle, ['', 'Unclaimed', $currentUnclaimedTotal]);
        fputcsv($handle, ['', 'Unadopted', $currentUnadoptedTotal]);

        fclose($handle);
        $this->info("Saved CSV to: $csvPath");

        return 0;
    }
}
