<?php

namespace App\Services;
use App\Models\Feedback;



class FeedbackService
{

       public function getAll()
       {
              return Feedback::all();
       }

       public function getById($id)
       {
              return Feedback::findOrFail($id);
       }

       public function create(array $data)
       {
              return Feedback::create($data);
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

       public function updateStatus($id, $status)
       {
              $feedback = $this->getById($id);
              if (!$feedback) {
                     throw new \Exception('Feedback não encontrado!');
              }
              $feedback->situacao_fk = $status;
              $feedback->save();
              return $feedback;
       }
}