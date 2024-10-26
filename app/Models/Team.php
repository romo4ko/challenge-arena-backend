<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Team extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'captain_id'
    ];

    protected $appends = [
        'active_challenges',
        'completed_challenges'
    ];

    public function captain(): HasOne
    {
        return $this->hasOne(User::class, 'captain_id');
    }

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

    public function getActiveChallengesAttribute(): Collection
    {
        return $this->challenges()
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->get();
    }

    public function getCompletedChallengesAttribute(): Collection
    {
        return $this->challenges()
            ->where('end_date', '<', Carbon::now())
            ->get();
    }

}
