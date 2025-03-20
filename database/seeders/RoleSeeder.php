<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $roles = [
      [
        'name' => 'user',
        'uuid' => Str::uuid(),
        'slug' => 'user',
        'description' => 'User role'
      ],
      [
        'name' => 'admin',
        'uuid' => Str::uuid(),
        'slug' => 'admin',
        'description' => 'Admin role'
      ],
      [
        'name' => 'super admin',
        'uuid' => Str::uuid(),
        'slug' => 'super-admin',
        'description' => 'Super Admin role'
      ],
    ];

    foreach ($roles as $role) {
      Role::create($role);
    }
  }
}
