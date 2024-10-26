<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'start_date',
        'end_date',
        'achievement_id',
        'image_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_challenges');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
