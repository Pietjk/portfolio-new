<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('employer_id')->nullable()->after('is_small')->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('year')->nullable()->after('employer_id');
        });

        // Backfill existing live rows so they keep a sensible order.
        DB::table('projects')->whereNull('year')->orderBy('id')->each(function ($project) {
            DB::table('projects')->where('id', $project->id)->update([
                'year' => $project->created_at ? (int) substr($project->created_at, 0, 4) : (int) date('Y'),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('employer_id');
            $table->dropColumn('year');
        });
    }
};
