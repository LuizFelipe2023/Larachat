<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Avaliacao;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           Avaliacao::factory()->create([
               'nome' => 'Muito Ruim'
           ]);
           Avaliacao::factory()->create([
               'nome' => 'Ruim'
           ]);
           Avaliacao::factory()->create([
               'nome' => 'Razoável'
           ]);
           Avaliacao::factory()->create([
               'nome' => "Bom"
           ]);
           Avaliacao::factory()->create([
               'nome' => 'Muito Bom'
           ]);
           Avaliacao::factory()->create([
                'nome' => 'Excelente'
           ]);
    }
}
