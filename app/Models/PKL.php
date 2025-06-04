<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pkls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'laporan_akhir',
        'status_pembimbing',
        'status_waka_hamas',
        'nilai',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'nilai' => 'integer',
    ];

    /**
     * Get the status pembimbing options.
     *
     * @return array
     */
    public static function getStatusPembimbingOptions()
    {
        return [
            'disetujui' => 'Disetujui',
            'revisi' => 'Revisi',
        ];
    }

    /**
     * Get the status waka humas options.
     *
     * @return array
     */
    public static function getStatusWakaHumasOptions()
    {
        return [
            'disetujui' => 'Disetujui',
        ];
    }
}
