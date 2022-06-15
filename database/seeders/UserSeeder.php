<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin TL 1',
            'username' => 'admin1',
            'phone_number' => '082123456789',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole('administrator');

        $user = User::create([
            'name' => 'Manager TL 1',
            'username' => 'manager1',
            'phone_number' => '082123456799',
            'email' => 'manager1@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $user->assignRole('manager');
    }
}
