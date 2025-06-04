<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePKLSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkls', function (Blueprint $table) {
            $table->id();
            $table->text('laporan_akhir');
            $table->enum('status_pembimbing', ['disetujui', 'revisi']);
            $table->enum('status_waka_humas', ['disetujui']);
            $table->bigInteger('nilai');
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
        Schema::dropIfExists('pkls');
    }
}
