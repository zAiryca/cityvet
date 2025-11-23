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

        $this->info("Generating report for $year-$month ...");

        $impoundedPets = Pet::whereYear('impounded_date', $year)
            ->whereMonth('impounded_date', $month)
            ->with('requests')
            ->orderBy('impounded_date', 'desc')
            ->get();

        foreach ($impoundedPets as $pet) {
            $completed = $pet->requests->where('status', 'completed')
                ->whereIn('type', ['adopt', 'claim'])
                ->sortByDesc('updated_at')
                ->first();
            $pet->adopted_date = $completed ? $completed->updated_at : null;
        }

        $impoundedCount = $impoundedPets->count();
        $currentImpoundedTotal = Pet::where('status', 'impounded')->count();
        $currentAdoptableTotal = Pet::where('status', 'adoptable')->count();
        $adoptedCount = $impoundedPets->filter(fn($p) => !is_null($p->adopted_date))->count();

        $data = [
            'impoundedPets' => $impoundedPets,
            'month' => $month,
            'year' => $year,
            'impoundedCount' => $impoundedCount,
            'currentImpoundedTotal' => $currentImpoundedTotal,
            'currentAdoptableTotal' => $currentAdoptableTotal,
            'adoptedCount' => $adoptedCount,
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
        fputcsv($handle, ['No.', 'Code Name', 'Species', 'Breed', 'Status', 'Impounded Date', 'Adopted Date']);
        $i = 1;
        foreach ($impoundedPets as $pet) {
            fputcsv($handle, [
                $i++,
                $pet->display_code,
                $pet->species,
                $pet->breed,
                $pet->status,
                $pet->impounded_date ? $pet->impounded_date->toDateString() : '',
                $pet->adopted_date ? $pet->adopted_date->toDateString() : '',
            ]);
        }

        // Summary rows
        fputcsv($handle, []);
        fputcsv($handle, ['Summary', 'Metric', 'Value']);
        fputcsv($handle, ['', 'Impounded this month', $impoundedCount]);
        fputcsv($handle, ['', 'Claimed this month', 'N/A']);
        fputcsv($handle, ['', 'Adopted this month', $adoptedCount]);

        fclose($handle);
        $this->info("Saved CSV to: $csvPath");

        return 0;
    }
}
