<?php

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'email' => 'test@mail.net',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'first_name' => 'User',
            'last_name' => 'Test',
            'address' => '1234 Main St',
            'city' => 'Springfield',
            'phone' => '123 456 7890'
        ]);

        for ($i = 0; $i < 10; ++$i)
        {
            User::create([
                'email' => "user$i@mail.net",
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]);
        }
    }
}
