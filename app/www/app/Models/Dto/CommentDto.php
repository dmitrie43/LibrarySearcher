<?php

declare(strict_types=1);

namespace App\Models\Dto;

final class CommentDto
{
    public function __construct(
        public string $theme,
        public string $text,
        public string $type,
        public int $itemId,
        public int $userId,
        public bool $isRecommended = false,
        public bool $isApproved = false,
        public ?int $id = null,
    ) {}
}
