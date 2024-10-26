<?php

namespace App\Models;

use App\Enums\ChallengeType;
use Carbon\Carbon;
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

    protected $appends = [
        'is_finished',
        'is_in_progress',
        'type_name'
    ];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'users_challenges');
    }

    public function achievement(): HasOne
    {
        return $this->hasOne(Achievement::class, 'id', 'achievement_id');
    }

    public function teams(): belongsToMany
    {
        return $this->belongsToMany(Team::class, 'teams_challenges');
    }

    public function getIsFinishedAttribute(): bool
    {
        return $this->end_date < Carbon::now();
    }

    public function getIsInProgressAttribute(): bool
    {
        return $this->start_date < Carbon::now() && $this->end_date > Carbon::now();
    }

    public function getTypeNameAttribute()
    {
        return $this->type == ChallengeType::PERSONAL->value ? 'Персональный' : 'Командный';
    }
}
