<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul_berita');
            $table->text('isi_berita');
            $table->string('gambar')->nullable();
            $table->string('sumber');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8);
            $table->string('nama_program');
            $table->string('pelaku')->nullable();
            $table->string('tahun')->nullable();
            $table->float('anggaran')->nullable();
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->char('id_tujuan', 2);
            $table->char('id_target', 5);
            $table->char('id_indikator', 8);
            $table->char('id_program', 4);
            $table->string('nama_kegiatan');
            $table->string('pelaku')->nullable();
            $table->float('anggaran')->nullable();
            $table->char('tahun', 5)->nullable();
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('komentar');
            $table->string('rating');
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('pesan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('pesan');
            $table->string('instansi')->nullable();
            $table->char('status', 30)->nullable();
            $table->char('flag', 2)->default('1');;
            $table->char('created_by', 5)->nullable();
            $table->char('updated_by', 5)->nullable();
            $table->timestamps();
        });

        Schema::create('subscriber', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
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
        Schema::dropIfExists('table2');
    }
}
