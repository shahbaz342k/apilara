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

        // $user = \App\Models\User::insert([

        //     ['name' => 'Admin' , 'email' => 'admin@gmail.com', 'password' => bcrypt('admin@123')],
        //     ['name' => 'John Doe' , 'email' => 'test2@gmail.com', 'password' => bcrypt('password123')],
        //     ['name' => 'John Ss' , 'email' => 'test3@gmail.com', 'password' => bcrypt('password123')],
        //     ['name' => 'sdf' , 'email' => 'test4@gmail.com', 'password' => bcrypt('password123')],
        // ]);
    }
}
