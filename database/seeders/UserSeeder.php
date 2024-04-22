<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Leo Antonio',
            'email' => 'anto@hotmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Administrator');
        User::create([
            'full_name' => 'Tony Mendez',
            'email' => 'tomymendez@hotmail.com',
            'password' => Hash::make('12345678'),
        ])->assignRole('Author');

        User::factory(10)->create();
    }
}
