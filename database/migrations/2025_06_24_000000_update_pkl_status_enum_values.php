<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePklStatusEnumValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pkls MODIFY COLUMN status_waka_humas ENUM('disetujui', 'proses', 'ditolak')");
            DB::statement("ALTER TABLE pkls MODIFY COLUMN status ENUM('proses', 'berjalan', 'selesai', 'ditolak')");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pkls MODIFY COLUMN status_waka_humas ENUM('disetujui', 'proses')");
            DB::statement("ALTER TABLE pkls MODIFY COLUMN status ENUM('proses', 'berjalan', 'selesai')");
        }
    }
}
