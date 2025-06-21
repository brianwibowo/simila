<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoocModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mooc_modules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('module_name');
            $table->string('link_materi');
            $table->string('dokumen_materi');
            $table->unsignedBigInteger('mooc_id');
            $table->text('question');
            $table->text('pilihan_jawaban_1');
            $table->text('pilihan_jawaban_2');
            $table->text('pilihan_jawaban_3');
            $table->text('pilihan_jawaban_4');
            $table->string('answer');

            $table->foreign('mooc_id')->references('id')->on('moocs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mooc_modules');
    }
}
