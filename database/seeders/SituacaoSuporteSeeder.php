<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SituacaoSuporte;

class SituacaoSuporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           SituacaoSuporte::factory()->create([
              'nome' => 'Pendente'
           ]);
           SituacaoSuporte::factory()->create([
               'nome' => 'Em Processo de Resolução'
           ]);
           SituacaoSuporte::factory()->create([
                'nome' => 'Resolvido'
           ]);
    }
}
