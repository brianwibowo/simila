<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPklsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan kolom foreign key
        Schema::table('pkls', function (Blueprint $table) {
            // Hapus kolom nilai sementara
            $table->dropColumn('nilai');
        });

        // Tambahkan kolom baru dengan tipe yang benar
        Schema::table('pkls', function (Blueprint $table) {
            // Tambahkan kolom foreign key
            $table->unsignedBigInteger('siswa_id')->after('id');
            $table->unsignedBigInteger('pembimbing_id')->after('siswa_id');
            $table->unsignedBigInteger('perusahaan_id')->after('pembimbing_id');
            
            // Tambahkan kolom tambahan yang diperlukan
            $table->bigInteger('nilai')->nullable()->after('status_waka_humas');
            $table->text('catatan_waka_humas')->nullable()->after('nilai');
            $table->timestamp('tanggal_validasi_waka_humas')->nullable()->after('catatan_waka_humas');
            
            // Tambahkan foreign key constraints
            $table->foreign('siswa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pembimbing_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('perusahaan_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkls', function (Blueprint $table) {
            // Hapus foreign key constraints
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['pembimbing_id']);
            $table->dropForeign(['perusahaan_id']);
            
            // Hapus kolom yang ditambahkan
            $table->dropColumn([
                'siswa_id',
                'pembimbing_id',
                'perusahaan_id',
                'catatan_waka_humas',
                'tanggal_validasi_waka_humas'
            ]);
            
            // Kembalikan kolom nilai ke tipe semula
            $table->dropColumn('nilai');
            $table->bigInteger('nilai');
        });
    }
}
