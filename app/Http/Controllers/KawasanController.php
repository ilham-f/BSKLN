<?php

namespace App\Http\Controllers;

use App\Models\Kawasan;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKawasanRequest;
use App\Http\Requests\UpdateKawasanRequest;

class KawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tabelkawasan', [
            'title' => 'Tabel Kawasan',
            'kawasans' => Kawasan::all(),
            'direktorats' => Direktorat::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kawasan' => 'required',
            'direktorat_id' => 'required',
        ]);

        $created = Kawasan::create($data);

        if ($created) {
            return back()->with('success','Data kawasan berhasil ditambahkan!');
        } else {
            return back()->with('failed','Data kawasan gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $kawasan = Kawasan::find($request->id);

        $deleted = $kawasan->delete();

        if ($deleted) {
            return back()->with('success', 'Data kawasan berhasil dihapus!');
        } else {
            return back()->with('failed', 'Data kawasan gagal dihapus!');
        }
    }

    public function getKawasan($direktorat_id)
    {
        $kawasans = Kawasan::where('direktorat_id', $direktorat_id)->pluck('nama_kawasan', 'id');
        return response()->json($kawasans);
    }

}
