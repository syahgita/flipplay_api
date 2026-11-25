<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Syahgita',
            'email' => 'syahgita@flipplay.test',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@flipplay.test',
            'password' => Hash::make('password123'),
        ]);
    }
}
