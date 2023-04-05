<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
            'id'             => 1,
            'name'           => 'Administrador Kiibo',
            'email'          => 'admin@kiibo.com',
            'rol'            => '1',
            'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO', //password
            'remember_token' => null,
            'created_at'     => '2023-04-04 09:13:32',
            'updated_at'     => '2023-04-04 09:13:32',

            ],
        ];
        $users = [
            [
            'id'             => 2,
            'name'           => 'Usuario Kiibo',
            'email'          => 'usuario@kiibo.com',
            'password'       => '$2y$10$imU.Hdz7VauIT3LIMCMbsOXvaaTQg6luVqkhfkBcsUd.SJW2XSRKO', //password
            'remember_token' => null,
            'created_at'     => '2023-04-04 09:13:32',
            'updated_at'     => '2023-04-04 09:13:32',

            ],
        ];
        User::insert($admin);
        User::insert($users);
    }
}
