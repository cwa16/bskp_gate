<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'slug',
        'color'
    ];

    public function roleAppApp()
    {
        return $this->hasMany(RoleApp::class);
    }
}
