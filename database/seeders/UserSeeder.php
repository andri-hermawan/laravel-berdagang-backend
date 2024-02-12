<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(2)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'andri.hermawan.skom@gmail.com',
            'password' => Hash::make('123'),
            'roles' => 'ADMIN',
            'phone' => '082113933140',
        ]);
    }
}
