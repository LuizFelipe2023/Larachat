<?php
namespace App\Http\Controllers;
use App\Http\Requests\MelhoriaRequest;
use App\Services\MelhoriaService;
use Exception;
use Illuminate\Http\Request;
use Log;
class MelhoriaController extends Controller
{
    protected $melhoriaService;

    public function __construct(MelhoriaService $melhoriaService)
    {
        $this->melhoriaService = $melhoriaService;
    }

    public function storeMelhoria(MelhoriaRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->melhoriaService->create($validatedData);
            return redirect()->back()->with('success', 'Formulario de Melhorias foi submetido com sucesso');
        } catch (Exception $e) {
            Log::error('Houve um erro na inserção da melhoria. Erro: ' . $e->getMessage());
            return redirect()->back()->withErrors('Houve um erro inesperado ao inserir o registro de melhoria no sistema. Por favor tente novamente');
        }
    }

    public function updateMelhoria($id, MelhoriaRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $this->melhoriaService->update($id, $validatedData);
            return redirect()->back()->with('success', 'A atualização da melhoria foi um sucesso');
        } catch (Exception $e) {
            Log::error('Houve um erro na atualização da melhoria. Erro: ' . $e->getMessage());
            return redirect()->back()->withErrors('Houve um erro inesperado ao atualizar o registro de melhoria no sistema. Por favor, tente novamente.');
        }
    }

    public function deleteMelhoria($id)
    {
        try {
            $this->melhoriaService->delete($id);
            return redirect()->back()->with('success', 'A melhoria foi deletada com sucesso.');
        } catch (Exception $e) {
            Log::error('Houve um erro ao deletar a melhoria. Erro: ' . $e->getMessage());
            return redirect()->back()->withErrors('Houve um erro inesperado ao tentar deletar o registro de melhoria. Por favor, tente novamente.');
        }
    }


}
