<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Achievement extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['name', 'description', 'image_id'];

    public function challenges(): BelongsToMany
    {
        return $this->belongsToMany(Challenge::class);
    }

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function images(): hasOne
    {
        return $this->hasOne(Image::class);
    }

    public function teams(): belongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
