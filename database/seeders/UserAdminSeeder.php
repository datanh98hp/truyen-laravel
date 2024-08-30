<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         User::query()->create([
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'email' => 'dat198hp@gmail.com',
            'level' => 1,
         ]);
    }
}
