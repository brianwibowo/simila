<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pkls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nilai' => 'integer',
        'tanggal_validasi_waka_humas' => 'datetime',
    ];

    /**
     * Get the status pembimbing options.
     *
     * @return array
     */
    public static function getStatusPembimbingOptions()
    {
        return [
            'disetujui' => 'Disetujui',
            'revisi' => 'Revisi',
            'proses' => 'Proses',
        ];
    }

    /**
     * Get the status waka humas options.
     *
     * @return array
     */
    public static function getStatusWakaHumasOptions()
    {
        return [
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'proses' => 'Proses',
        ];
    }

    public function siswas()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(User::class, 'perusahaan_id');
    }
}
