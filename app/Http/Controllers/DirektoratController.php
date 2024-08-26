<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDirektoratRequest;
use App\Http\Requests\UpdateDirektoratRequest;

class DirektoratController extends Controller
{
    public function getDirektoratColors() {
        // Fetch all direkotorats with their colors
        $direktorats = Direktorat::all(['id', 'warna']);

        // Create an associative array of direktorat id => color
        $direktoratColors = $direktorats->pluck('warna', 'id')->toArray();

        // Fetch all negara with their direktorat_id
        $negara = Negara::all(['kode_negara', 'direktorat_id']);

        // Create an associative array of region code => color
        $negaraColors = $negara->mapWithKeys(function ($item) use ($direktoratColors) {
            return [$item->kode_negara => $direktoratColors[$item->direktorat_id] ?? '#FFFFFF'];
        })->toArray();

        // Return the JSON response
        return response()->json($negaraColors);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tabeldirektorat', [
            'title' => 'Tabel Direktorat',
            'direktorats' => Direktorat::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_direktorat' => 'required',
            'warna' => 'required',
        ]);

        $created = Direktorat::create($data);

        if ($created) {
            return back()->with('success','Data direktorat berhasil ditambahkan!');
        } else {
            return back()->with('failed','Data direktorat gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $direktorat = Direktorat::find($request->id);

        $deleted = $direktorat->delete();

        if ($deleted) {
            return back()->with('success', 'Data direktorat berhasil dihapus!');
        } else {
            return back()->with('failed', 'Data direktorat gagal dihapus!');
        }
    }
}
