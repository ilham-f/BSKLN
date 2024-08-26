<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $negaras = Negara::all();
        $negaraData = $negaras->mapWithKeys(function ($negara) {
            $code = $negara->code ?? 'default_code'; // Provide a default code if null or empty
            return [
                $code => [
                    'nama_negara' => $negara->nama_negara,
                    'direktorat' => $negara->direktorats->nama_direktorat ?? 'Unknown Directorate',
                    'kawasan' => $negara->kawasans->nama_kawasan ?? 'Unknown Region',
                    'flag' => asset($negara->flag)
                ]
            ];
        });

        // Debug the data
        // dd($negaraData->toJson());

        return view('dashboard', [
            'title' => 'Dashboard',
            'negaraData' => $negaraData
        ]);
    }

}
