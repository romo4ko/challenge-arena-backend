<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
