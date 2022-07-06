<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tujuan', function (Blueprint $table) {
            $table->id();
            $table->string('judul_tujuan');
            $table->text('penjelasan')->nullable();
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
        Schema::create('target', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5)->unique();
            $table->string('judul_target');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
        Schema::create('indikator', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8)->unique();
            $table->string('judul_target');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tujuan');
    }
}
