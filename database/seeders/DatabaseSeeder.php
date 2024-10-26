<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            AchievementsSeeder::class,
            ChallengesSeeder::class,
            TeamsSeeder::class,
            UsersAchievementsSeeder::class,
            UserTeamsSeeder::class,
            UserChallengesSeeder::class,
            TeamsAchievementsSeeder::class,
            TeamsChallengesSeeder::class
        ]);
    }
}
