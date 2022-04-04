<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 10; $i++) {
            $userData[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => bcrypt('password123'),
            ];
        }

        foreach ($userData as $user) {
            $user = \App\Models\User::create($user);
            $user->assignRole('customer');
        }

        $admin_user = \App\Models\User::create(

            ['name' => 'Admin' , 'email' => 'admin@gmail.com', 'password' => bcrypt('admin@123')]
           
        );
        $admin_user->assignRole('admin');

    }
}
