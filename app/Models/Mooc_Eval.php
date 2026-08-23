<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Mooc_Eval model — table mooc_evals was dropped in cleanup migration.
 * Model kept for backwards compatibility in case the quiz feature is re-enabled.
 */
class Mooc_Eval extends Model
{
    use HasFactory;

    protected $table = 'mooc_evals';

    protected $guarded = ['id'];

    public function mooc()
    {
        return $this->belongsTo(Mooc::class, 'mooc_id');
    }
}
