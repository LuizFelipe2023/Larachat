<?php

namespace App\Services;
use App\Models\SituacaoSuporte;

class SituacaoSuporteService
{
      public function getAll()
      {
             return SituacaoSuporte::all();
      }
}