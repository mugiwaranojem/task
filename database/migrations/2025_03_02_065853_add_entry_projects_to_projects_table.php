<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Project Alpha',
                'description' => 'Alpha project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Project Beta',
                'description' => 'Beta project',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('projects')->whereIn('title', ['Project Alpha', 'Project Beta'])->delete();
    }
};
