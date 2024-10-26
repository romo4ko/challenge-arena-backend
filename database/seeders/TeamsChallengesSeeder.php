<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Challenge;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class TeamsChallengesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::query()->limit(5)->get();
        $challenges = Challenge::query()->limit(5)->get();

        foreach ($teams as $team) {
            foreach ($challenges as $challenge) {
                $team->challenges()->attach($challenge);
            }
        }
    }
}
