<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Riset extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'risets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topik',
        'deskripsi',
        'tim_riset',
        'file_proposal',
        'dokumentasi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tim_riset' => 'array',
    ];

    /**
     * Get all of the anggota for the Riset
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota_Riset::class, 'id_risets');
    }
}
