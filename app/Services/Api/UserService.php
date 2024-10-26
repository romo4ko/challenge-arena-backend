<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function show()
    {
    }

    public function update(User $user, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        if ($user->id === auth()->id()) {
            $savedImage = null;

            if ($userUpdateDTO->image) {
                $savedImage = $userUpdateDTO->image->store(options: ['disk' => 'public']);
            }

            $user->update([
                'image' => Storage::disk('public')->url($savedImage),
                'name' => $userUpdateDTO->name,
                'surname' => $userUpdateDTO->surname,
                'patronymic' => $userUpdateDTO->patronymic,
                'email' => $userUpdateDTO->email,
                'about' => $userUpdateDTO->about,
            ]);

            return $user->toArray();
        }

        return response()->json(['message' => 'just meme'], 403);
    }

    public function team()
    {
    }

    public function challenge()
    {
    }
}
