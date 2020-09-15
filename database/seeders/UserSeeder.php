<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'User',
            'last_name' => 'Test',
            'address' => '1234 Main St',
            'city' => 'Springfield',
            'phone' => '123 456 7890',
            'email' => 'test@mail.net',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::factory()->count(9)->create();
    }
}
