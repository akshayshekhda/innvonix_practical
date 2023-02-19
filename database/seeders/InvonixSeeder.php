<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRoleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvonixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userRole = [[ 'name' => 'Admin'],['name' => 'Manager'],[ 'name' => 'Developer']];

        foreach ($userRole as $role) {
            UserRoleModel::create($role);
        }
    }
}