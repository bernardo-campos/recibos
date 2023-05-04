<?php

namespace Database\Seeders;

use App\Models\Concept;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConceptsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $concepts = [
            "Gastos administrativos",
            "Matrícula",
            "Reintegro de Asignaciones familiares",
            "Reintegro de Líquidos y Aportes- Pers. S/ Presupuesto",
        ];
        
        foreach ($concepts as $name) {
            Concept::create(['name' => $name]);
        }
    }
}
