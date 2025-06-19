<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function pkl()
    {
        return $this->belongsTo(PKL::class);
    }

    public function logbookContents()
    {
        return $this->hasMany(LogbookContent::class);
    }
}
