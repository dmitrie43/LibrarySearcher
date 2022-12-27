<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'user' => 'Пользователь',
            'admin' => 'Администратор',
            'moderator' => 'Модератор',
        ];
        foreach ($roles as $code => $role) {
            DB::table('roles')->insert([
                'name' => $role,
                'code' => $code,
            ]);
        }
    }
}
