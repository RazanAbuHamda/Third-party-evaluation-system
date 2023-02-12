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
            'name' => 'huda',
            'email' => 'enterprise@gmail.com',
            'password' => bcrypt('12345678'),
            'roles-name' => ['enterprise-user'],
            'status' => 'مفعّل',
        ]);

        $role = Role::create(['name' => 'enterprise-user']);
        $role->syncPermissions(['استعراض نتائج التقييمات']);
        $user->assignRole([$role->id]);


    }
}

