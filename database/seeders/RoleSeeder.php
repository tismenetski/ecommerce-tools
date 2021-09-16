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
    public function run()
    {

        $users = [
            0 => [
                'name' => 'superadmin',
                'description' => 'super admin user'
            ],
            1 => [
                'name' => 'admin',
                'description' => 'admin user'
            ],
            2 => [
                'name' => 'user',
                'description' => 'regular user'
            ]
            ];

        foreach ($users as $user) {
            Role::create([
                'name' => $user['name'],
                'description' => $user['description']
            ]);
        }

    }
}
