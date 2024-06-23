<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        $role = Role::create(['name' => 'user']);
        $permission = Permission::create(['name' => 'create website']);
        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        
        $role = Role::create(['name' => 'admin']);
        $permission1 = Permission::create(['name' => 'delete']);
        $role->givePermissionTo($permission1);
        $role->givePermissionTo($permission);
        $permission1->assignRole($role);
        $permission->assignRole($role);
       
    
    }
}
