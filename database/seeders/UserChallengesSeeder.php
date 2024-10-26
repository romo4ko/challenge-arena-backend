<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserChallengesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->limit(5)->get();
        $challenges = Challenge::query()->limit(5)->get();

        foreach ($users as $user) {
            foreach ($challenges as $challenge) {
                $user->challenges()->attach($challenge);
            }
        }
    }
}