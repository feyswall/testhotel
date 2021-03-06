<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'first_name' => 'Forbins',
            'last_name' => 'Bros',
            'user_name' => 'admin',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('owner');
    }
}
