<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Project;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        Project::all()->each(function (Project $project) {
            $project->update(['slug' => $this->uniqueSlug($project)]);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    private function uniqueSlug(Project $project): string
    {
        $base = Str::slug($project->title);
        $slug = $base;
        $i = 1;

        while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
};
