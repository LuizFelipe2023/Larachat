<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Suporte;

class GraficoController extends Controller
{
    public function graficosIndex()
    {
        $feedbacks = Feedback::selectRaw('nivel_satisfacao, count(*) as total')
            ->groupBy('nivel_satisfacao')
            ->orderBy('nivel_satisfacao')
            ->get();

        $suportes = Suporte::selectRaw('tipo_duvida, count(*) as total')
            ->groupBy('tipo_duvida')
            ->orderBy('tipo_duvida')
            ->get();

        $situacoes = Feedback::selectRaw('situacao_fk, count(*) as total')
            ->groupBy('situacao_fk')
            ->orderBy('situacao_fk')
            ->with('situacao')
            ->get();

        $statusSuportes = Suporte::selectRaw('status_id, count(*) as total')
            ->groupBy('status_id')
            ->with('status') 
            ->get();

        $nivelSatisfacaoLabels = [
            1 => 'Muito Insatisfeito',
            2 => 'Insatisfeito',
            3 => 'Neutro',
            4 => 'Satisfeito',
            5 => 'Excelente'
        ];

        $feedbacksData = $feedbacks->map(function ($item) use ($nivelSatisfacaoLabels) {
            return [
                'name' => $nivelSatisfacaoLabels[$item->nivel_satisfacao] ?? 'Desconhecido',
                'y' => $item->total,
            ];
        });

        $suportesData = $suportes->map(function ($item) {
            return [
                'name' => $item->tipo_duvida,
                'y' => $item->total,
            ];
        });

        $situacoesData = $situacoes->map(function ($item) {
            return [
                'name' => $item->situacao->nome ?? 'Desconhecido',
                'y' => $item->total,
            ];
        });

        $statusSuportesData = $statusSuportes->map(function ($item) {
            return [
                'name' => $item->status->nome ?? 'Desconhecido', // Nome do status
                'y' => $item->total,
            ];
        });

        return view('graficos.index', compact('feedbacksData', 'suportesData', 'situacoesData', 'statusSuportesData'));
    }

}
