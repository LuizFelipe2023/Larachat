<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SituacaoFeedback;

class SituacaoFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           SituacaoFeedback::factory()->create([
                'nome' => 'Recebido'
           ]);
           SituacaoFeedback::factory()->create([
                'nome' => 'Em Aguardo de Implementação'
           ]);
           SituacaoFeedback::factory()->create([
                'nome' => 'Em Implementação'
           ]);
           SituacaoFeedback::factory()->create([
                'nome' => 'Implementado'
           ]);
    }
}
