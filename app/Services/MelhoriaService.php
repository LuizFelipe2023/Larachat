<?php

namespace App\Services;

use App\Models\Melhoria;

class MelhoriaService
{

    public function getAll()
    {
        return Melhoria::all();
    }
    public function getById($id)
    {
        return Melhoria::findOrFail($id);
    }
    public function create(array $data)
    {
        return Melhoria::create($data);
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

}