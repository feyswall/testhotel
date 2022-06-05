<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'feyswal',
            'last_name' => 'mkota',
            'user_name' => 'owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('owner');
    }
}
