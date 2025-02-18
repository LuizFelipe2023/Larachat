<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Melhoria extends Model
{
      protected $fillable = ['feedback_id','acao','data_implementacao'];

      public function feedback()
      {
             return $this->belongsTo(Feedback::class,'feedback_id','id');
      }
}
