<?php

namespace App\Models;

use App\Observers\AuthorObserver;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([AuthorObserver::class])]
class Author extends Model
{
    use HasFactory, HasImage;

    protected $fillable = [
        'full_name',
        'photo',
    ];

    protected array $images = [
        'photo',
    ];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => !empty($value) ? $value : $this->getDefaultPhoto(),
        );
    }

    protected function getDefaultPhoto(): string
    {
        return '/img/usericon.svg';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
