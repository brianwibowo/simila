<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class GuruTamu extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guru_tamus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_karyawan',
        'jabatan',
        'keahlian',
        'deskripsi',
        'jadwal',
        'file_cv',
        'file_materi',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'jadwal' => 'datetime',
    ];

    /**
     * Get the status options for the guru tamu.
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            'pending' => 'Menunggu Konfirmasi',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            'selesai' => 'Selesai',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kurikulum) {
            if ($kurikulum->file_cv) {
                Storage::disk('public')->delete($kurikulum->file_cv);
            }
            if ($kurikulum->file_materi) {
                Storage::disk('public')->delete($kurikulum->file_materi);
            }
        });
    }

    /**
     * Get the jadwal in a formatted way.
     *
     * @return string
     */
    public function getFormattedJadwalAttribute()
    {
        return $this->jadwal ? $this->jadwal->format('d F Y H:i') : '-';
    }
}
