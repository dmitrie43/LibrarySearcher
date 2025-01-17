<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\select;

class Role extends Model
{
    use HasFactory;

    protected $casts = [
        'is_allow_admin_panel' => 'boolean',
    ];

    public static function getDefaultRole(): ?array
    {
        return self::query()
            ->where('code', 'user')
            ->first();
    }

    public static function getAllowAdminPanelRolesId(): array
    {
        return self::query()
            ->select('id')
            ->where('is_allow_admin_panel', 1)
            ->pluck('id')
            ->toArray();
    }
}
