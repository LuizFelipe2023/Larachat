<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Requests\SituacaoRequest;
use App\Models\SituacaoFeedback;
use Exception;
use Illuminate\Http\Request;
use App\Services\FeedbackService;
use Illuminate\Support\Facades\Log; 
use App\Services\SituacaoService;

class FeedbackController extends Controller
{
    protected $feedbackService;
    protected $situacaoService;

    public function __construct(FeedbackService $feedbackService, SituacaoService $situacaoService)
    {
        $this->feedbackService = $feedbackService;
        $this->situacaoService = $situacaoService;
    }
    
    public function index()
    {
        Log::info('Acessando a lista de feedbacks'); 

        $feedbacks = $this->feedbackService->getAll();
        $situacoes = $this->situacaoService->getAll();

        Log::info('Feedbacks e situações carregadas com sucesso', ['feedbacks' => $feedbacks, 'situacoes' => $situacoes]); 

        return view('feedbacks.index', compact('feedbacks','situacoes'));
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

    public function updateSituacao($id, SituacaoRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->feedbackService->updateStatus($id, $validatedData['situacao_fk']);
            return redirect()->back()->with('success', 'Situação do Feedback foi atualizada com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar a situação do Feedback. Erro: '.$e->getMessage());
            return redirect()->back()->withErrors('Houve um erro inesperado ao atualizar a situação do Feedback, por favor tente novamente');
        }
    }
    
}
