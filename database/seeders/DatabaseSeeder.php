<?php

namespace Database\Seeders;

use Database\Seeders\ConceptsSeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\FromsSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([FromsSeeder::class]);
        $this->call([ConceptsSeeder::class]);
        $this->call([RoleSeeder::class]);
        $this->call([PermissionSeeder::class]);
        $this->call([CurrencySeeder::class]);
    }
}
