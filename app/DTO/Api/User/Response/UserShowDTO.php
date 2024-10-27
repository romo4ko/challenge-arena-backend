<?php

namespace App\DTO\Api\User\Response;

use App\Models\User;
use Spatie\LaravelData\Data;

class UserShowDTO extends Data
{
    public function __construct(
        public User $user,
        public bool $isEditor
    ){
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user,
            $user->id === auth()->id()
        );
    }
}
