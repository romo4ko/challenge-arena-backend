<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Challenge extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'result',
        'achievement_id',
        'image',
        'type'
    ];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'users_challenges');
    }

    public function achievements(): belongsToMany
    {
        return $this->belongsToMany(Achievement::class);
    }

    public function teams(): belongsToMany
    {
        return $this->belongsToMany(Team::class, 'teams_challenges');
    }
}
