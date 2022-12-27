<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory;

    /**
     * @return object|null
     */
    public static function getDefaultRole() : ?object
    {
        return self::where('code', 'user')->first();
    }
}
