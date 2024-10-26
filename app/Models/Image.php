<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_path'];

    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    public function challenges(): hasMany
    {
        return $this->hasMany(Challenge::class);
    }

    public function achievements(): hasMany
    {
        return $this->hasMany(Achievement::class);
    }
}
