<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->create([
                'email' => config('app.default_user.email'),
                'password' => Hash::make(config('app.default_user.password')),
                'name' => 'Admin',
            ]);
    }
}
