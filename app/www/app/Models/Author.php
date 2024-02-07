<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Author extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'full_name',
        'photo',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function book()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function defaultSearch(string $query) : Collection
    {
        return $this->query()
            ->where('full_name', 'like', "%{$query}%")
            ->limit(20)
            ->get();
    }
}
