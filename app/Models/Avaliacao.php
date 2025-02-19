<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avaliacao extends Model
{
      use HasFactory;
      protected $fillable = ['nome'];

      protected $table = 'avaliacoes';

      public function suporte()
      {
             return $this->hasMany(Suporte::class);
      }
}
