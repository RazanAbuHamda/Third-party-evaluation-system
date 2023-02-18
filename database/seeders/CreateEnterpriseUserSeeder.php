<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateEnterpriseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Huda',
            'email' => 'enterprise@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => ['enterprise-user'],
            'enterprise_id' => '1',
            'status' => 'enabled',
        ]);

        $role = Role::create(['name' => 'enterprise-user']);
        $role->syncPermissions(['Show users']);
        $user->assignRole([$role->id]);


    }
}

