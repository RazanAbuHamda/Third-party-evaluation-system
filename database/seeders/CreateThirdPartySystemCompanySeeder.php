<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateThirdPartySystemCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enterprise = Enterprise::create([
            'enterprise_name' => 'Third party system',
            'email' => 'third-party-system@gmail.com',
            'password' => bcrypt('12345678'),
            'status' => 'enabled',
        ]);



    }
}

