<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $role_user = new Role();
      $role_user->name = 'User';
      $role_user->description = "A normal User";
      $role_user->save();

      $role_auther = new Role();
      $role_auther->name = 'Author';
      $role_auther->description = "A normal Author";
      $role_auther->save();

      $role_admin = new Role();
      $role_admin->name = 'Admin';
      $role_admin->description = "A normal Admin";
      $role_admin->save();
    }
}
