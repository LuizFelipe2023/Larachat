<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SituacaoSuporte extends Model
{
      use HasFactory;
      protected $fillable = ['nome'];

      protected $table = 'situacoes_suporte';

      public function suportes()
      {
             return $this->hasMany(Suporte::class);
      }
}
