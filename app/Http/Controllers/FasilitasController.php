<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('content.admin.fasilitas', compact('fasilitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas'
        ]);
    
        Fasilitas::create($request->only('nama_fasilitas'));
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas,nama_fasilitas,'.$fasilitas->id
        ]);
    
        $fasilitas->update($request->only('nama_fasilitas'));
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
    return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
