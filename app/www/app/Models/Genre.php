<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'genre_book');
    }

    public function scopeWithBooks(Builder $query): void
    {
        $query->has('books');
    }
}
