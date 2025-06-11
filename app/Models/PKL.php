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
    protected $fillable = [
        'siswa_id',
        'pembimbing_id',
        'perusahaan_id',
        'laporan_akhir',
        'status_pembimbing',
        'status_waka_humas',
        'nilai',
        'catatan_waka_humas',
        'tanggal_validasi_waka_humas'
    ];

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
     * Get the student that owns the PKL.
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    /**
     * Get the pembimbing that owns the PKL.
     */
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }

    /**
     * Get the perusahaan that owns the PKL.
     */
    public function perusahaan()
    {
        return $this->belongsTo(User::class, 'perusahaan_id');
    }

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
}
