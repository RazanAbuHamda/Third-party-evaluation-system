<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //admin permission
            'Add user',
            'Edit users',
            'Show users',
            'Delete user',
            'Add enterprise',
            'Edit enterprises',
            'Show enterprises',
            'Show enterprise forms',
            'Add form',
            'Show forms',
            'Delete form',
            'Edit forms'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
