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
            'name' => 'Admin',
            'email' => 'admin@mail.net',
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);

        for ($i = 0; $i < 10; ++$i)
        {
            User::create([
                'name' => "User $i",
                'email' => "user$i@mail.net",
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]);
        }
    }
}
