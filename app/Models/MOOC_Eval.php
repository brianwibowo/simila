<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOOC_Eval extends Model
{
    use HasFactory;

    protected $table = 'mooc_evals';

    protected $guarded = ['id'];

    public function mooc()
    {
        return $this->belongsTo(MOOC::class, 'mooc_id');
    }
}
