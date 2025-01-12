<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public static function getDefaultRole(): ?object
    {
        return self::where('code', 'user')->first();
    }

    //TODO
    public static function getAllowAdminPanelRolesId(): array
    {
        $arItems = self::where('access_admin_panel', '1')->select('id')->get()->toArray();
        $res = [];
        foreach ($arItems as $item) {
            $res[] = $item['id'];
        }

        return $res;
    }
}
