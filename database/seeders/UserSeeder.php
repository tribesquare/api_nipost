<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
          'name' => 'John Doe',
          'email' => 'manager@superadmin.com',
          'role_id' => 3,
          'created_by' => 'System',
          'status' => 'active',
          'staff_code' => 'MGR-001',
          'password' => bcrypt('password'),
        ]);
    }
}
