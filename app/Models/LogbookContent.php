<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LogbookContent extends Model
{
    use HasFactory;

    protected $table = 'logbook_content';

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($logbook) {
            if ($logbook->dokumentasi) {
                Storage::disk('public')->delete($logbook->dokumentasi);
            }
        });
    }

    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
