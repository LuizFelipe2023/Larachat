<?php
namespace App\Http\Controllers;
use App\Http\Requests\SearchSuporteRequest;
use App\Http\Requests\SuporteRequest;
use App\Services\SuporteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SituacaoSuporteService;
use App\Models\Avaliacao;

class SuporteController extends Controller
{
    protected $suporteService;
    protected $situacaoSuporteService;

    public function __construct(SuporteService $suporteService, SituacaoSuporteService $situacaoSuporteService)
    {
        $this->suporteService = $suporteService;
        $this->situacaoSuporteService = $situacaoSuporteService;
    }

    public function indexSuporte()
    {
        Log::info('Acessando a lista de suportes');

        $suportes = $this->suporteService->getAll();
        $statuses = $this->situacaoSuporteService->getAll();

        Log::info('Suportes carregados', ['suportes' => $suportes]);

        return view('suportes.index', compact('suportes', 'statuses'));
    }

    public function createSuporte()
    {
        Log::info('Acessando o formulário de criação de suporte');
        return view('suportes.createSuporte');
    }

    public function storeSuporte(SuporteRequest $request)
    {
        try {
            Log::info('Recebendo dados para criar suporte', ['data' => $request->all()]);

            $validatedData = $request->validated();

            Log::info('Dados validados para criação', ['validatedData' => $validatedData]);

            $this->suporteService->create($validatedData);

            Log::info('Suporte criado com sucesso');

            return redirect()->route('home')->with('success', 'Mensagem enviada com sucesso para o suporte');
        } catch (Exception $e) {
            Log::error('Erro ao criar suporte: ' . $e->getMessage());

            return redirect()->back()->withErrors('Houve um erro inesperado ao enviar a mensagem para o suporte. Por favor, tente novamente.')->withInput();
        }
    }

    public function updateSuporte($id, SuporteRequest $request)
    {
        try {
            Log::info('Recebendo dados para atualizar suporte com ID: ' . $id, ['data' => $request->all()]);

            $validatedData = $request->validated();

            Log::info('Dados validados para atualização', ['validatedData' => $validatedData]);

            $this->suporteService->update($id, $validatedData);

            Log::info('Suporte atualizado com sucesso');

            return redirect()->route('suportes.index')->with('success', 'Mensagem de Suporte atualizada com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar suporte: ' . $e->getMessage());

            return redirect()->back()->withErrors('Houve um erro ao atualizar a mensagem de suporte. Por favor, tente novamente.')->withInput();
        }
    }

    public function deleteSuporte($id)
    {
        try {
            Log::info('Tentando deletar o suporte com ID: ' . $id);

            $this->suporteService->delete($id);

            Log::info('Suporte deletado com sucesso');

            return redirect()->route('suportes.index')->with('success', 'Suporte deletado com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao tentar excluir o suporte com ID ' . $id . ': ' . $e->getMessage());

            return redirect()->back()->withErrors('Houve um erro ao tentar excluir o suporte. Por favor, tente novamente.');
        }
    }

    public function searchSuporte(SearchSuporteRequest $request)
    {
        try {
            $validatedData = $request->validated();

            Log::info('Buscando suporte pelo CPF', ['cpf' => $validatedData['cpf']]);

            $suportes = $this->suporteService->getSuporteByCpf($validatedData['cpf']);

            if ($suportes->isEmpty()) {
                Log::warning('Nenhum suporte encontrado para o CPF informado', ['cpf' => $validatedData['cpf']]);
                return redirect()->back()->withErrors(['cpf' => 'Nenhum suporte encontrado para este CPF.']);
            }

            return redirect()->route('suportes.resultado', ['cpf' => $validatedData['cpf']]);

        } catch (Exception $e) {
            Log::error('Erro ao buscar suporte pelo CPF', [
                'cpf' => $request->cpf,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro ao buscar o suporte. Tente novamente mais tarde.']);
        }
    }

    public function showSuporte(SearchSuporteRequest $request)
    {
        $validatedData = $request->validated();
        $suportes = $this->suporteService->getSuporteByCpf($validatedData['cpf']);
        $tiposAvaliacoes = Avaliacao::all();
        return view('suportes.showSuporte', compact('suportes', 'tiposAvaliacoes'));
    }

    public function inserirAvaliacao(Request $request, $id)
    {
        try {
            Log::info("Tentativa de inserção de avaliação para o suporte ID: {$id}");

            $validatedData = $request->validate([
                'avaliacao_id' => 'required|exists:avaliacoes,id'
            ]);

            $this->suporteService->inserirAvaliacao($id, $validatedData['avaliacao_id']);  // Corrected here

            Log::info("Avaliação inserida com sucesso para o suporte ID: {$id}, Avaliação ID: {$validatedData['avaliacao_id']}");  // Corrected here

            return redirect()->back()->with('success', 'Avaliação Inserida com sucesso');
        } catch (Exception $e) {
            Log::error("Erro ao inserir avaliação para o suporte ID: {$id}. Erro: " . $e->getMessage(), [
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro ao inserir a avaliação. Tente novamente mais tarde.']);
        }
    }

}
