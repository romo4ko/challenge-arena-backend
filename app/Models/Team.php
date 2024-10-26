<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'code'
    ];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'users_teams');
    }

    public function challenges(): belongsToMany
    {
        return $this->belongsToMany(Challenge::class, 'teams_challenges');
    }

    public function achievements(): belongsToMany
    {
        return $this->belongsToMany(Achievement::class, 'teams_achievements');
    }
}
