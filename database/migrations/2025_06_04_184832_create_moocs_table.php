<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOOCSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moocs', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pelatihan');
            $table->text('deskripsi');
            $table->string('link_materi');
            $table->string('dokumen_materi');
            $table->string('sertifikat');
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
        Schema::dropIfExists('moocs');
    }
}
