<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suporte extends Model
{
      protected $fillable = ['nome_cliente','telefone_cliente','email_cliente','tipo_duvida','descricao','status_id','resposta','avaliacao_id','cpf'];

      protected $table = 'suportes';

      public function status()
      {
             return $this->belongsTo(SituacaoSuporte::class,'status_id','id');
      }

      public function avaliacao()
      {
             return $this->belongsTo(Avaliacao::class,'avaliacao_id','id');
      }
}
