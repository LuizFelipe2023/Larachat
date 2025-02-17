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
    
        $feedbacksData = $feedbacks->map(function ($item) {
            return [
                'name' => $item->nivel_satisfacao,
                'y' => $item->total,
            ];
        });
    
        $suportesData = $suportes->map(function ($item) {
            return [
                'name' => $item->tipo_duvida,
                'y' => $item->total,
            ];
        });
    
        return view('graficos.index', compact('feedbacksData', 'suportesData'));
    }
    
    
}
