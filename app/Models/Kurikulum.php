<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Kurikulum extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    // Explicitly define fillable fields for clarity
    protected $fillable = [
        'nama_kurikulum',
        'pengirim_id',
        'perusahaan_id',
        'tahun_ajaran',
        'deskripsi',
        'file_kurikulum',
        'validasi_sekolah',
        'validasi_perusahaan',
        'komentar'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kurikulum) {
            if ($kurikulum->file_kurikulum) {
                Storage::disk('public')->delete($kurikulum->file_kurikulum);
            }
        });
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
