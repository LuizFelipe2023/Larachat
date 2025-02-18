<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SituacaoFeedback extends Model
{
      use HasFactory;
      protected $fillable = ['nome'];

      protected $table = 'situacoes_feedback';

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'situacao_fk');
    }
}
