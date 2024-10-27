<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => env('ADMIN_LOGIN'),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'is_admin' => true,
        ]);
    }
}
