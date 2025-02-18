<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
      protected $fillable = ['nivel_satisfacao', 'descricao', 'nome_cliente', 'cpf_cliente', 'situacao_fk'];

      protected $table = 'feedbacks';

      public function situacao()
      {
            return $this->belongsTo(SituacaoFeedback::class, 'situacao_fk');
      }

}
