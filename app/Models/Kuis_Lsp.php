<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuis_Lsp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nilai',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nilai' => 'integer',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the kuis.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the soal_lsps for the kuis.
     */
    public function soalLsps(): HasMany
    {
        return $this->hasMany(Soal_Lsp::class, 'kuis_lsp_id');
    }

    /**
     * Check if the kuis is completed.
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return !is_null($this->completed_at);
    }
}
