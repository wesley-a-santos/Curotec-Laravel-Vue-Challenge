<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'User'],
        ];

        foreach ($roles as $role) {
            $newRole = new Role();
            $newRole->id = $role['id'];
            $newRole->name = $role['name'];
            $newRole->save();
        }
    }
}
