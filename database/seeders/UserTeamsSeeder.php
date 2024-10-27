<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->limit(5)->get();
        $teams = Team::query()->limit(5)->get();

        foreach ($users as $user) {
            foreach ($teams as $team) {
                $user->teams()->attach($team);
            }
        }
    }
}
