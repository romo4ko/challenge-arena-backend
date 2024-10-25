<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image_id'];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
