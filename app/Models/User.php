<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'jenis_guru',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted(){
        static::created(function($user){
            if(!$user->hasAnyRole()){
                $user->assignRole('user');
            }
        });

        parent::boot();

        static::deleting(function ($user) {
            if ($user->laporan_pkl) {
                Storage::disk('public')->delete($user->laporan_pkl);
            }
        });
    }

    public function pklSiswa(){
        return $this->belongsTo(PKL::class, 'pkl_id');
    }

    public function pklPerusahaan(){
        return $this->hasMany(PKL::class, 'perusahaan_id');
    }

    public function pklPembimbing(){
        return $this->hasMany(PKL::class, 'pembimbing_id');
    }

    public function moocs(){
        return $this->hasMany(Mooc::class, 'perusahaan_id');
    }

    public function logbook(){
        return $this->hasOne(Logbook::class, 'siswa_id');
    }
}