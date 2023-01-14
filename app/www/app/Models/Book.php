<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Book extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name', 'date_publish', 'cover_img', 'pages_quantity',
        'description', 'age_rating', 'novelty', 'popular', 'recommended',
    ];

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

    /**
     * @param string $query
     * @return Collection
     */
    public function defaultSearch(string $query) : Collection
    {
        return $this->query()
            ->where('name', 'like', "%{$query}%")
            ->limit(20)
            ->get();
    }
}
