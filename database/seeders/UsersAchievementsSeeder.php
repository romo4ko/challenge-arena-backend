<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersAchievementsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::query()->limit(5)->get();
        $achievements = Achievement::query()->limit(5)->get();

        foreach ($users as $user) {
            foreach ($achievements as $achievement) {
                $user->achievements()->attach($achievement);
            }
        }
    }
}
