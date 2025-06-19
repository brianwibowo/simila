<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookContent extends Model
{
    use HasFactory;

    protected $table = 'logbook_content';

    protected $guarded = ['id'];

    public function logbook()
    {
        return $this->belongsTo(Logbook::class);
    }
}
