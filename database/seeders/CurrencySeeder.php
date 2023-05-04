<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'symbol' => '$',
            'name' => 'Pesos',
        ]);
        Currency::create([
            'symbol' => 'US$',
            'name' => 'Dólares',
        ]);
        Currency::create([
            'symbol' => '€',
            'name' => 'Euros',
        ]);
    }
}
