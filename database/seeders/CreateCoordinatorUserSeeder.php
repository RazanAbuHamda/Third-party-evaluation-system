<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateCoordinatorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Shams',
            'email' => 'coordinator@gmail.com',
            'password' => bcrypt('12345678'),
            'roles-name' => ['coordinator'],
            'status' => 'مفعّل',
        ]);

        $role = Role::create(['name' => 'coordinator']);
        $role->syncPermissions(['جمع التقييمات']);
        $user->assignRole([$role->id]);




    }
}
