<?php

namespace App\Repositories;

use App\Models\Negara;

class NegaraRepository
{
    public function getAllNegara()
    {
        return Negara::with('direktorats', 'kawasans')->get();
    }

    public function getNegaraById($id)
    {
        return Negara::with('direktorats', 'kawasans')->findOrFail($id);
    }

    public function getNegaraByCode($code)
    {
        return Negara::with('direktorats', 'kawasans')->where('kode_negara', $code)->first();
    }

    public function create(array $data): Negara
    {
        return Negara::create($data);
    }

    public function find($id): ?Negara
    {
        return Negara::find($id);
    }

    public function delete($id): void
    {
        Negara::destroy($id);
    }
}

