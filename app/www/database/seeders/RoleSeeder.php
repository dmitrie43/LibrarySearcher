<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $roles = [
            'user' => [
                'name' => 'Пользователь',
                'access' => 0,
            ],
            'admin' => [
                'name' => 'Администратор',
                'access' => 1,
            ],
            'moderator' => [
                'name' => 'Модератор',
                'access' => 1,
            ],
        ];
        foreach ($roles as $code => $arRole) {
            Role::create([
                'name' => $arRole['name'],
                'code' => $code,
                'is_allow_admin_panel' => $arRole['access'] ?? 0,
            ]);
        }
    }
}
