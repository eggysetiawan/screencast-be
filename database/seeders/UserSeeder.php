<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        $users = [
            [
                'name' => 'Rahmat Setiawan',
                'email' => 'setiawaneggy@gmail.com',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Povilas Korop',
                'email' => 'povilas@example.com',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Irsyad Panjaitan',
                'email' => 'irsyad@example.com',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Sandhika Galih',
                'email' => 'sandhikagalih@example.com',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]
        ];
        foreach ($users as $user) {
            $accounts = User::create($user);

            if ($accounts->name == 'Rahmat Setiawan') {
                $accounts->assignRole('admin');
            } else {
                $accounts->assignRole('instructor');
            }
        }
    }
}
