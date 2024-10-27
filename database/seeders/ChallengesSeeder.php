<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Challenge;
use Illuminate\Database\Seeder;

class ChallengesSeeder extends Seeder
{
    public function run(): void
    {
        $challenges = config('base.challenges');

        if (env('APP_DEBUG')) {
            Challenge::factory(10)->create();
        } else {
            foreach ($challenges as $challenge) {
                Challenge::factory()->create($challenge);
            }
        }
    }
}
