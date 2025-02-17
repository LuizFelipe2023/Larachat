<?php
namespace App\Http\Controllers;
use App\Http\Requests\SuporteRequest;
use App\Services\SuporteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class SuporteController extends Controller
{
    protected $suporteService;

    public function __construct(SuporteService $suporteService)
    {
        $this->suporteService = $suporteService;
    }

    public function indexSuporte()
    {
        Log::info('Acessando a lista de suportes'); // Log de informação

        $suportes = $this->suporteService->getAll();

        Log::info('Suportes carregados', ['suportes' => $suportes]); // Log de informação com os dados carregados

        return view('suportes.index', compact('suportes'));
    }

    public function createSuporte()
    {
        Log::info('Acessando o formulário de criação de suporte'); // Log de informação
        return view('suportes.createSuporte');
    }

    public function storeSuporte(SuporteRequest $request)
    {
        try {
            Log::info('Recebendo dados para criar suporte', ['data' => $request->all()]); // Log de informação com os dados recebidos

            $validatedData = $request->validated();

            Log::info('Dados validados para criação', ['validatedData' => $validatedData]); // Log de informação com dados validados

            $this->suporteService->create($validatedData);

            Log::info('Suporte criado com sucesso'); // Log de informação

            return redirect()->route('suportes.index')->with('success', 'Mensagem enviada com sucesso para o suporte');
        } catch (Exception $e) {
            Log::error('Erro ao criar suporte: ' . $e->getMessage()); // Log de erro com a mensagem de erro

            return redirect()->back()->withErrors('Houve um erro inesperado ao enviar a mensagem para o suporte. Por favor, tente novamente.');
        }
    }

    public function editSuporte($id)
    {
        Log::info('Acessando o formulário de edição do suporte com ID: ' . $id); // Log de informação com ID

        $suporte = $this->suporteService->getById($id);

        Log::info('Suporte carregado para edição', ['suporte' => $suporte]); // Log de informação com dados do suporte

        return view('suportes.editSuporte', compact('suporte'));
    }

    public function updateSuporte($id, SuporteRequest $request)
    {
        try {
            Log::info('Recebendo dados para atualizar suporte com ID: ' . $id, ['data' => $request->all()]); // Log de informação com dados recebidos para atualização

            $validatedData = $request->validated();

            Log::info('Dados validados para atualização', ['validatedData' => $validatedData]); // Log de informação com dados validados

            $this->suporteService->update($id, $validatedData);

            Log::info('Suporte atualizado com sucesso'); // Log de informação

            return redirect()->route('suportes.index')->with('success', 'Mensagem de Suporte atualizada com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar suporte: ' . $e->getMessage()); // Log de erro com a mensagem de erro

            return redirect()->back()->withErrors('Houve um erro ao atualizar a mensagem de suporte. Por favor, tente novamente.');
        }
    }

    public function deleteSuporte($id)
    {
        try {
            Log::info('Tentando deletar o suporte com ID: ' . $id); // Log de informação com ID

            $this->suporteService->delete($id);

            Log::info('Suporte deletado com sucesso'); // Log de informação

            return redirect()->route('suportes.index')->with('success', 'Suporte deletado com sucesso');
        } catch (Exception $e) {
            Log::error('Erro ao tentar excluir o suporte com ID ' . $id . ': ' . $e->getMessage()); // Log de erro com a mensagem de erro

            return redirect()->back()->withErrors('Houve um erro ao tentar excluir o suporte. Por favor, tente novamente.');
        }
    }
}
