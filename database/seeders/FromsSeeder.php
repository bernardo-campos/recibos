<?php

namespace Database\Seeders;

use App\Models\From;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FromsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            "Colegio Cristo Rey",
            "COLEGIO LA SAGRADA FAMILIA",
            "Instituto Juan XXIII",
            "Instituto Maria Antonia de Paz y Figueroa",
            "INSTITUTO SAN ISIDRO EL LABRADOR",
            "INSTITUTO NUESTRO SEÑOR DE MAILIN LL-33",
            "IES María Auxiliadora",
            "Instituto Nuestra Señora de la Consolación de Sumampa",
            "Instituto Superior Santo Tomás de Aquino",
            "INSTITUTO SAN CAYETANO",
            "IES PABLO VI",
            "Instituto San Roque",
        ];
        
        foreach ($arr as $name) {
            From::create(['name' => $name]);
        }

    }
}
