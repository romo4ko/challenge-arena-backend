<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Services\Api\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function show(int $id): array
    {
        return User::query()->findOrFail($id)?->toArray();
    }

    public function update()
    {
    }

    public function team()
    {
    }

    public function challenge()
    {
    }
}
