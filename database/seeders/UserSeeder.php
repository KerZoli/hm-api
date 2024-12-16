<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->afterCreating(function (User $user) {
                $user->assignRole(RolesEnum::SUPER_ADMIN);
            })
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'username' => 'Admin',
            ]);
    }
}
