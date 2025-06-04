<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Anggota_Riset extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anggota_risets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'riset_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'riset_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Get the riset that owns the anggota.
     */
    public function riset(): BelongsTo
    {
        return $this->belongsTo(Riset::class);
    }

    /**
     * Get the user that owns the anggota.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
