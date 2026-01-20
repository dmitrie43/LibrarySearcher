<?php

declare(strict_types=1);

namespace App\Models\Dto;

final class UserDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password,
        public int $role_id,
        public ?string $avatar = null,
        public ?string $remember_token = null,
        public ?\DateTime $created_at = null,
        public ?\DateTime $updated_at = null,
        public ?\DateTime $deleted_at = null,
    ) {}
}
