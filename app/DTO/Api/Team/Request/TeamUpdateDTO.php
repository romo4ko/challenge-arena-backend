<?php

namespace App\DTO\Api\Team\Request;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class TeamUpdateDTO extends Data
{
    public function __construct(
        #[Max(255)]
        public ?string $name,
        #[Max(255)]
        public ?string $description,
        public ?UploadedFile $image,
    ){
    }
}
