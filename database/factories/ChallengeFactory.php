<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ChallengeType;
use App\Models\Achievement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChallengeFactory extends Factory
{
    public function definition(): array
    {
        $now = Carbon::now();

        return [
            'name' => fake()->text(20),
            'description' => fake()->text(),
            'start_date' => $now,
            'end_date' => $now->addDays(rand(1, 30)),
            'achievement_id' => Achievement::query()->inRandomOrder()->first(),
            'image' => null,
            'type' => fake()->randomElement([
                ChallengeType::PERSONAL,
                ChallengeType::TEAM
            ])
        ];
    }
}
