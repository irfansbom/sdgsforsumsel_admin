<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapaianTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_capaian', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 15);
            $table->char('kd_wilayah', 5);
            $table->char('tahun', 5);
            $table->float('target')->nullable();
            $table->float('capaian')->nullable();
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
        Schema::drop('indikator_capaian');
        Schema::drop('indikator_target');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capaian_target');
        Schema::drop('indikator_capaian');
        Schema::drop('indikator_target');
    }
}
