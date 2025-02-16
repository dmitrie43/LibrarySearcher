<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $casts = [
        'is_allow_admin_panel' => 'boolean',
    ];

    /**
     * @return Role|null
     */
    public static function getDefaultRole(): ?Role
    {
        return self::query()
            ->where('code', 'user1')
            ->first();
    }

    /**
     * @return int[]
     */
    public static function getAllowAdminPanelRolesId(): array
    {
        return self::query()
            ->select('id')
            ->where('is_allow_admin_panel', 1)
            ->pluck('id')
            ->toArray();
    }
}
