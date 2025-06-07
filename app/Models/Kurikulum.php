<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kurikulum',
        'deskripsi',
        'created_at',
        'updated_at',
        'pengirim_id',
        'tahun_ajaran',
        'file_kurikulum',
        'komentar',
        'validasi_sekolah',
        'validasi_perusahaan'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
