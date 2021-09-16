<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([

            'name' => 'Stas Tismenetski',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password')

        ])->roles()->attach(1);

       //$superadmin->roles()->attach(1);

        User::create([

            'name' => 'Borat Sagdiev',
            'email' => 'siteadmin@gmail.com',
            'password' => bcrypt('password')

        ])->roles()->attach(2);

        User::create([

            'name' => 'Tutar Sagdiev',
            'email' => 'enduser@gmail.com',
            'password' => bcrypt('password')

        ])->roles()->attach(3);
    }
}
