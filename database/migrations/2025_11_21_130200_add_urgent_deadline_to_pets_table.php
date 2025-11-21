<?php

// Migration intentionally left as a no-op because the `urgent_deadline` feature
// was removed. Keeping this migration file avoids altering migration history
// while preventing accidental re-creation of the column.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // no-op
    }

    public function down(): void
    {
        // no-op
    }
};
