<?php

declare(strict_types=1);

namespace App\DTO\Api\User\Request;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class UserUpdateDTO extends Data
{
    public function __construct(
        #[Image]
        public ?UploadedFile $image,
        #[Max(255)]
        public ?string $name,
        #[Max(255)]
        public ?string $surname,
        #[Max(255)]
        public ?string $patronymic,
        #[Max(255)]
        public ?string $email,
        #[Max(255)]
        public ?string $about,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
        ];
    }
}
