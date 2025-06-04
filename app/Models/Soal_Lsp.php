<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Soal_Lsp extends Model
{
    use HasFactory;

    public function kuisLsp(): BelongsTo
    {
        return $this->belongsTo(Kuis_Lsp::class, 'kuis_lsp_id');
    }
}
