<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sertifikasis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_siswa',
        'nama_lsp',
        'kompetensi',
        'dokumen_persyaratan',
        'nilai',
        'sertifikat_kelulusan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'dokumen_persyaratan' => 'array',
        'nilai' => 'integer',
    ];
}
