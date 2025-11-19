<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pet;

class ArchiveExpiredPets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pets:archive-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive pets that have exceeded their holding period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all impounded and adoptable pets, then filter those that should be archived
        $expiredPets = Pet::whereIn('status', ['impounded', 'adoptable'])
            ->get()
            ->filter(function ($pet) {
                return $pet->shouldBeArchived();
            });

        $count = 0;
        foreach ($expiredPets as $pet) {
            if ($pet->archiveIfExpired()) {
                $count++;
                $this->info("Archived pet ID {$pet->id} ({$pet->name})");
            }
        }

        $this->info("Archived {$count} expired pets.");
        return Command::SUCCESS;
    }
}
