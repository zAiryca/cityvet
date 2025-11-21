<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Console\Command;

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
        $petsToTransition = Pet::where('status', 'impounded')
            ->whereNotNull('impounded_date')
            ->where('impounded_date', '<=', now()->subDays(3))
            ->get();

        $count = 0;
        foreach ($petsToTransition as $pet) {
            $pet->update([
                'status' => 'adoptable',
                'decision_date' => now()
            ]);
            $count++;
        }

        $this->info("Transitioned {$count} pets from impounded to adoptable.");
        return Command::SUCCESS;
    }
}

