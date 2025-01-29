<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Book $book */
        $book = $this->resource;

        return [
            'id' => $book->id,
            'cover_img' => $book->cover_img,
            'name' => $book->name,
            'author' => [
                'full_name' => $book->author->full_name ?? null,
            ],
        ];
    }
}
