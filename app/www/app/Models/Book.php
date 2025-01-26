<?php

namespace App\Models;

use App\Observers\BookObserver;
use App\Traits\HasComments;
use App\Traits\HasFile;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

#[ObservedBy([BookObserver::class])]
class Book extends Model
{
    use HasFactory, HasFile, HasImage, Searchable, HasComments;

    protected $fillable = [
        'name', 'date_publish', 'cover_img', 'pages_quantity', 'file',
        'description', 'age_rating', 'is_novelty', 'is_popular', 'is_recommended',
        'author_id', 'publisher_id',
    ];

    protected $casts = [
        'is_novelty' => 'boolean',
        'is_popular' => 'boolean',
        'is_recommended' => 'boolean',
    ];

    protected array $images = [
        'cover_img',
    ];

    protected array $files = [
        'file',
    ];

    protected function coverImg(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => ! empty($value) ? $value : $this->getDefaultCoverImg(),
        );
    }

    protected function getDefaultCoverImg(): string
    {
        return '/img/template.webp';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_book', 'book_id', 'genre_id');
    }

    public function scopeNovelty(Builder $query): void
    {
        $query->where('is_novelty', 1);
    }

    public function scopePopular(Builder $query): void
    {
        $query->where('is_popular', 1);
    }

    public function scopeRecommended(Builder $query): void
    {
        $query->where('is_recommended', 1);
    }

    /**
     * Получите индексируемый массив данных для модели.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingPrefix(['id'])]
    #[SearchUsingFullText(['description'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
