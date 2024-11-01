<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fasiha',
            'email' => 'faisha@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '08111229333',
            'roles' => 'ADMIN',
        ]);
    }
}
