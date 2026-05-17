<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TransitionImpoundedToPets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pets:transition-impounded-to-adoptable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically transition impounded pets to adoptable after 3 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find all impounded pets that have been impounded for 3+ days
        // Use date-only comparison to avoid time-of-day mismatches
        $cutDate = now()->subDays(3)->toDateString();
        $petsToTransition = Pet::where('status', 'impounded')
            ->whereNotNull('impounded_date')
            ->whereDate('impounded_date', '<=', $cutDate)
            ->get();

        $this->line('Found ' . $petsToTransition->count() . " impounded pets meeting impounded_date <= {$cutDate}");

        $count = 0;
        foreach ($petsToTransition as $pet) {
            $this->line("Considering pet {$pet->id}: impounded_date={$pet->impounded_date}, decision_date={$pet->decision_date}");
            Log::info('TransitionImpoundedToPets considering', ['pet_id' => $pet->id, 'impounded_date' => (string)$pet->impounded_date, 'decision_date' => (string)$pet->decision_date]);
            // Set the decision_date to the end of the impound holding period
            // (impounded_date + 3 days). This preserves the intended total
            // lifecycle: impounded (3 days) -> adoptable (4 days) => unadopted.
            // Using impounded_date + 3 ensures pets that have already
            // exceeded the full 7 days become eligible immediately.
            $decisionDate = $pet->impounded_date instanceof \Carbon\Carbon
                ? $pet->impounded_date->copy()->addDays(3)
                : now();

            $pet->update([
                'status' => 'adoptable',
                'decision_date' => $decisionDate,
            ]);
            $count++;
        }

        $this->info("Transitioned {$count} pets from impounded to adoptable.");
        return Command::SUCCESS;
    }
}

