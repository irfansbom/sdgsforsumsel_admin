<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable extends Migration
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
            $table->string('nama_tujuan');
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
            $table->string('nama_target');
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
            $table->string('nama_indikator');
            $table->string('satuan_data');
            $table->string('sumber_data');
            $table->float('range_min');
            $table->float('range_max');
            $table->char('legenda', 20);
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('indikator_capaian', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8)->unique();
            $table->char('kd_wilayah', 5);
            $table->char('tahun', 5);
            $table->float('data');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
        Schema::create('indikator_target', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8)->unique();
            $table->char('kd_wilayah', 5);
            $table->char('tahun', 5);
            $table->float('data');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('penunjang_judul', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8);
            $table->string('judul_penunjang');
            $table->string('satuan_data');
            $table->string('sumber_data');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('penunjang_data', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8);
            $table->char('id_penunjang_judul', 4);
            $table->char('kd_wilayah', 5);
            $table->char('tahun', 5);
            $table->float('data');
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
