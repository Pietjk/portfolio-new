<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->string('site');
            $table->string('github')->nullable();
            $table->string('image_path');
            $table->boolean('is_small');
            $table->timestamps();
        });

        $dt = now();
        DB::table('projects')->insert([
            [
                'title' => 'Groot project',
                'text' => 'Aliquam quis varius tortor. Mauris laoreet massa sollicitudin mauris euismod, ut cursus ante posuere. Etiam velit arcu, eleifend eget faucibus ac, scelerisque eu purus. Morbi ut nisi quis sapien fermentum ultrices. In facilisis urna turpis, eu aliquet risus condimentum in. Vivamus non nisi ultrices, tempus erat at, imperdiet felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
                'site' => 'https://www.pietonline.com',
                'github' => 'https://www.github.com/Pietjk',
                'image_path' => 'images/piet_logo_grain.png',
                'is_small' => false,
                'created_at' => $dt,
                'updated_at' => $dt,
            ],
            [
                'title' => 'Klein project',
                'text' => 'Aliquam quis varius tortor. Mauris laoreet massa sollicitudin mauris euismod, ut cursus ante posuere. Etiam velit arcu, eleifend eget faucibus ac, scelerisque eu purus. Morbi ut nisi quis sapien fermentum ultrices. In facilisis urna turpis, eu aliquet risus condimentum in. Vivamus non nisi ultrices, tempus erat at, imperdiet felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.',
                'site' => 'https://www.pietonline.com',
                'github' => 'https://www.github.com/Pietjk',
                'image_path' => 'images/piet_logo_grain.png',
                'is_small' => true,
                'created_at' => $dt,
                'updated_at' => $dt,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
