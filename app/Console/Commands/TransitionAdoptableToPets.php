<?php

namespace App\Console\Commands;

use App\Models\Pet;
use Illuminate\Console\Command;

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
        $petsToTransition = Pet::where('status', 'adoptable')
            ->whereNotNull('decision_date')
            ->where('decision_date', '<=', now()->subDays(4))
            ->get();

        $count = 0;
        foreach ($petsToTransition as $pet) {
            $pet->update([
                'status' => 'unadopted'
            ]);
            $count++;
        }

        $this->info("Transitioned {$count} pets from adoptable to unadopted.");
        return Command::SUCCESS;
    }
}

