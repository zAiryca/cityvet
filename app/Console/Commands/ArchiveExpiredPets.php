<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Archive pets that have exceeded their 7-day holding period';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired pets...');

        $expiredPets = \App\Models\Pet::whereIn('status', ['impounded', 'adoptable'])
            ->whereRaw('DATEDIFF(NOW(), impounded_date) >= 7')
            ->get();

        if ($expiredPets->isEmpty()) {
            $this->info('No expired pets found.');
            return;
        }

        $archivedCount = 0;
        foreach ($expiredPets as $pet) {
            if ($pet->archiveIfExpired()) {
                $archivedCount++;
                $this->line("Archived pet {$pet->display_code} ({$pet->status} → " . ($pet->status === 'impounded' ? 'unclaimed' : 'unadopted') . ")");
            }
        }

        $this->info("Successfully archived {$archivedCount} pets.");
    }
}
