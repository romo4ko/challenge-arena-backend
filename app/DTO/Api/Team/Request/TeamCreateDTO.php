<?php

namespace App\DTO\Api\Team\Request;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;

class TeamCreateDTO extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public ?UploadedFile $image,
    ){
    }
}
