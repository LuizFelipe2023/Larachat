<?php

namespace App\Services;

use App\Models\SituacaoFeedback;


class SituacaoService{

      public function getAll()
      {
             return SituacaoFeedback::all();
      }
}