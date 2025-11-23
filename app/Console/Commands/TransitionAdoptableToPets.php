<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TransitionAdoptableToPets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pets:transition-adoptable-to-unadopted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically transition adoptable pets to unadopted after 4 days with no adoption';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find all adoptable pets that have been adoptable for 4+ days
        // Use date-only comparison to avoid time-of-day mismatches
        $cutDate = now()->subDays(4)->toDateString();
        $petsToTransition = Pet::where('status', 'adoptable')
            ->whereNotNull('decision_date')
            ->whereDate('decision_date', '<=', $cutDate)
            ->get();

        $this->line('Found ' . $petsToTransition->count() . " adoptable pets meeting decision_date <= {$cutDate}");

        $count = 0;
        foreach ($petsToTransition as $pet) {
            $this->line("Considering pet {$pet->id}: decision_date={$pet->decision_date}");
            Log::info('TransitionAdoptableToPets considering', ['pet_id' => $pet->id, 'decision_date' => (string)$pet->decision_date]);
            $pet->update([
                'status' => 'unadopted'
            ]);
            $count++;
        }

        $this->info("Transitioned {$count} pets from adoptable to unadopted.");
        return Command::SUCCESS;
    }
}

