<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot(); 

        static::deleting(function ($project) {
            if ($project->file_brief) {
                Storage::disk('public')->delete($project->file_brief);
            }
        });
    }
}