<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'kompetensi_keahlian')) {
                $table->string('kompetensi_keahlian')->nullable()->after('nis');
            }
        });

        Schema::table('pkls', function (Blueprint $table) {
            if (!Schema::hasColumn('pkls', 'alamat_mitra')) {
                $table->text('alamat_mitra')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('pkls', 'mentor_industri')) {
                $table->string('mentor_industri')->nullable()->after('alamat_mitra');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nis')) {
                $table->dropColumn('nis');
            }
            if (Schema::hasColumn('users', 'kompetensi_keahlian')) {
                $table->dropColumn('kompetensi_keahlian');
            }
        });

        Schema::table('pkls', function (Blueprint $table) {
            if (Schema::hasColumn('pkls', 'alamat_mitra')) {
                $table->dropColumn('alamat_mitra');
            }
            if (Schema::hasColumn('pkls', 'mentor_industri')) {
                $table->dropColumn('mentor_industri');
            }
        });
    }
};
