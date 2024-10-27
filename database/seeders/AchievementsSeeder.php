<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementsSeeder extends Seeder
{
    public function run(): void
    {
        $achievements = config('base.achievements');

        foreach ($achievements as $achievement) {
            Achievement::query()->create($achievement);
        }
    }
}
