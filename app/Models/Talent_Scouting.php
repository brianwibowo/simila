<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent_Scouting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talent_scoutings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_alumni',
        'file_cv',
        'file_ijazah',
        'file_pernyataan',
        'status_seleksi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status_seleksi' => 'string',
    ];

    /**
     * Get the status seleksi options.
     *
     * @return array
     */
    public static function getStatusSeleksiOptions()
    {
        return [
            'lolos' => 'Lolos',
            'tidak lolos' => 'Tidak Lolos',
        ];
    }
}
