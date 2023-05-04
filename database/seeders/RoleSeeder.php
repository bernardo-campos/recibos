<?php

namespace Database\Seeders;

use App\Constants\RoleType;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => RoleType::ADMIN]);
        Role::create(['name' => RoleType::USER]);
    }
}
