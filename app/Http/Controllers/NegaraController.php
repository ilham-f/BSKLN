<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Repositories\NegaraRepository;
use App\Http\Requests\StoreNegaraRequest;
use App\Http\Requests\UpdateNegaraRequest;

class NegaraController extends Controller
{
    protected $negaraRepository;

    public function __construct(NegaraRepository $negaraRepository)
    {
        $this->negaraRepository = $negaraRepository;
    }

    public function allNegara(): JsonResponse
    {
        $negaras = $this->negaraRepository->getAllNegara();
        return response()->json($negaras);
    }

    public function showNegara($id): JsonResponse
    {
        $negara = $this->negaraRepository->getNegaraById($id);
        return response()->json($negara);
    }

    public function showNegaraByCode($code): JsonResponse
    {
        $negara = $this->negaraRepository->getNegaraByCode($code);
        return response()->json($negara);
    }

    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'nama_negara' => 'required|string|max:255',
            'kode_negara' => 'required|string|max:255',
            'direktorat_id' => 'required|exists:direktorats,id',
            'kawasan_id' => 'required|exists:kawasans,id',
        ]);

        $negara = $this->negaraRepository->create($request->all());

        return response()->json([
            'message' => 'Negara berhasil ditambahkan',
            'negara' => $negara
        ], 201);
    }

    public function delete($id): JsonResponse
    {
        $negara = $this->negaraRepository->find($id);

        if (!$negara) {
            return response()->json(['message' => 'Negara tidak ditemukan'], 404);
        }

        $this->negaraRepository->delete($id);

        return response()->json(['message' => 'Negara berhasil dihapus']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tabelnegara', [
            'title' => 'Tabel Negara',
            'negaras' => Negara::all(),
            'direktorats' => Direktorat::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_negara' => 'required',
            'kode_negara' => 'required',
            'direktorat_id' => 'required',
            'kawasan_id' => 'required',
            'flag' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        if ($request->hasFile('flag')) {
            // Get the file from the request
            $file = $request->file('flag');

            // Create a unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to the public/flag directory
            $file->move(public_path('flag'), $filename);

            // Save the path in the database
            $data['flag'] = 'flag/' . $filename;
        }

        $created = Negara::create($data);

        if ($created) {
            return back()->with('success', 'Data negara berhasil ditambahkan!');
        } else {
            return back()->with('failed', 'Data negara gagal ditambahkan!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $negara = Negara::find($request->id);

        $deleted = $negara->delete();

        if ($deleted) {
            return back()->with('success', 'Data negara berhasil dihapus!');
        } else {
            return back()->with('failed', 'Data negara gagal dihapus!');
        }
    }
}
