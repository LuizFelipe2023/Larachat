<?php

namespace App\Services;

use App\Models\Suporte;

class SuporteService
{
       public function getAll()
       {
              return Suporte::all();
       }

       public function getById($id)
       {
              return Suporte::findOrFail($id);
       }

       public function create(array $data)
       {
              return Suporte::create($data);
       }

       public function update($id, array $data)
       {
              $feedback = $this->getById($id);
              $feedback->update($data);
              return $feedback;
       }

       public function delete($id)
       {
              $feedback = $this->getById($id);
              return $feedback->delete();
       }

       public function getSuporteByCpf($cpf)
       {
              $suporte = Suporte::where('cpf', $cpf)->get();

              if ($suporte->isEmpty()) {
                     return response()->json(['message' => 'Nenhum suporte encontrado para este CPF.'], 404);
              }

              return $suporte;
       }

       public function inserirAvaliacao($id, $avaliacao)
       {
              $suporte = $this->getById($id);
              $suporte->avaliacao_id = $avaliacao;
              $suporte->save();
       }



}