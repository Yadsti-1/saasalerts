<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Yadier Mayoral',
            'email' => 'admin@admin',
            'password' => Hash::make('password'),
            'is_active' => true,
        ]);

        $admin->assignRole('admin');
    }
}
