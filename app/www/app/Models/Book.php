<?php

namespace App\Models;

use App\Observers\BookObserver;
use App\Traits\HasFile;
use App\Traits\HasImage;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

#[ObservedBy([BookObserver::class])]
class Book extends Model
{
    use HasFactory, HasFile, HasImage, Searchable;

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

    // TODO
    public function defaultSearch(string $query): Collection
    {
        return $this->query()
            ->where('name', 'like', "%{$query}%")
            ->limit(20)
            ->get();
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
}
