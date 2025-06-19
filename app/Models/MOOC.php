<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MOOC extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'moocs';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($materi) {
            if ($materi->dokumen_materi) {
                Storage::disk('public')->delete($materi->dokumen_materi);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'perusahaan_id');
    }
}
