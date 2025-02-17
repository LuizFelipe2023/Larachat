<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use Exception;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use Illuminate\Support\Facades\Log; 

class FeedbackController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }
    
    public function index()
    {
        Log::info('Acessando a lista de feedbacks'); 

        $feedbacks = $this->feedbackService->getAll();

        Log::info('Feedbacks carregados com sucesso', ['feedbacks' => $feedbacks]); 

        return view('feedbacks.index', compact('feedbacks'));
    }
 

    public function updateFeedback(FeedbackRequest $request, $id)
    {
        try {
            Log::info('Tentando atualizar o feedback com ID: ' . $id, ['data' => $request->all()]); 

            $validatedData = $request->validated();

            Log::info('Dados validados para atualização do feedback', ['validatedData' => $validatedData]); 

            $this->feedbackService->update($id, $validatedData);

            Log::info('Feedback atualizado com sucesso', ['id' => $id]); 

            return redirect()->route('feedbacks.index')->with('success', 'Feedback atualizado com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar o feedback com ID: ' . $id . '. Erro: ' . $e->getMessage()); 

            return redirect()->route('feedbacks.index')->with('error', 'Erro ao atualizar o feedback.')->withInput();
        }
    }

    public function deleteFeedback($id)
    {
        try {
            Log::info('Tentando deletar o feedback com ID: ' . $id); 

            $this->feedbackService->delete($id);

            Log::info('Feedback excluído com sucesso', ['id' => $id]); 

            return redirect()->route('feedbacks.index')->with('success', 'Feedback excluído com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao tentar excluir o feedback com ID ' . $id . '. Erro: ' . $e->getMessage()); 

            return redirect()->route('feedbacks.index')->with('error', 'Erro ao excluir o feedback.');
        }
    }
}
