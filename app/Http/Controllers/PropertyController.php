<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use App\Models\AlamatProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('content.pemilik.create_property', compact('fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_properti' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tipe' => 'required|in:putra,putri,campur,kontrakan,kost',
            'sewa_jenis' => 'required|in:bulanan,tahunan',
            'harga' => 'required|integer',
            'jumlah_kamar' => 'required|integer',
            'kelurahan' => 'required|string',
            'jalan' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'foto.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_VT' => 'nullable|url',
            'fasilitas' => 'required|array',
        ]);

        // Simpan property
        $property = Property::create([
            'user_id' => Auth::id(),
            'nama_properti' => $request->nama_properti,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
            'tipe' => $request->tipe,
            'sewa_jenis' => $request->sewa_jenis,
            'jumlah_kamar' => $request->jumlah_kamar,
        ]);

        // Simpan alamat property
        AlamatProperty::create([
            'property_id' => $property->id,
            'kelurahan' => $request->kelurahan,
            'jalan' => $request->jalan,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        // Simpan foto properti
        $linkVT = $request->input('link_VT'); // ambil input dari form

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                if ($file->isValid()) {
                   $path = $file->store('property_images', 'public');
                   $property->fotos()->create([
                       'file_path' => $path,
                       'link_VT' => $linkVT, // simpan link virtual tour yang sama untuk semua foto
                   ]);
               }
           }
        }
        

        // Simpan fasilitas
        $property->fasilitas()->sync($request->fasilitas);

        return redirect()->route('property.create')->with('success', 'Property berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        
    }

    
    public function edit($id)
    {
    $property = Property::with(['alamatProperty', 'fasilitas', 'fotos'])
        ->where('user_id', Auth::id())
        ->findOrFail($id);

    $allFasilitas = Fasilitas::all();

    return view('content.pemilik.edit_property', compact('property', 'allFasilitas'));
    }

    
    public function update(Request $request, $id)
    {
    $request->validate([
        'nama_properti' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'tipe' => 'required|in:putra,putri,campur,kontrakan,kost',
        'sewa_jenis' => 'required|in:bulanan,tahunan',
        'jumlah_kamar' => 'required|integer|min:1',
        'kelurahan' => 'required|string|max:255',
        'jalan' => 'required|string|max:255',
        'rt' => 'required|string|max:5',
        'rw' => 'required|string|max:5',
        'fasilitas' => 'array',
        'fotos.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        'hapus_foto' => 'array', 
    ]);

    $property = Property::where('user_id', Auth::id())->findOrFail($id);

    $property->update($request->only(['nama_properti', 'harga', 'tipe', 'sewa_jenis', 'jumlah_kamar']));

    $property->alamatProperty()->update([
        'kelurahan' => $request->kelurahan,
        'jalan' => $request->jalan,
        'rt' => $request->rt,
        'rw' => $request->rw,
    ]);

    $property->fasilitas()->sync($request->fasilitas);

    // Hapus foto yang dicentang
    if ($request->has('hapus_foto')) {
        foreach ($request->hapus_foto as $fotoId) {
            $foto = $property->fotos()->find($fotoId);
            if ($foto) {
                // Hapus file foto dari storage
                if (Storage::disk('public')->exists($foto->file_path)) {
                    Storage::disk('public')->delete($foto->file_path);
                }
                // Hapus record foto di DB
                $foto->delete();
            }
        }
    }

    // Upload foto baru
    if ($request->hasFile('fotos')) {
        foreach ($request->file('fotos') as $foto) {
            $path = $foto->store('property_images', 'public');
            $property->fotos()->create(['file_path' => $path]);
        }
    }

    if ($property->fotos->isNotEmpty()) {
        $property->fotos->first()->update([
            'link_VT' => $request->input('link_VT'),
        ]);
    }

    return redirect()->route('pemilik.property.edit', $property->id)->with('success', 'Properti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $property = Property::with('fotos', 'alamatProperty')->findOrFail($id);

    // Hapus file gambar dari storage
    foreach ($property->fotos as $foto) {
        if ($foto->file_path && Storage::disk('public')->exists('property_images/' . $foto->file_path)) {
            Storage::disk('public')->delete('property_images/' . $foto->file_path);
        }
    }

    // Hapus relasi (foto, alamat) secara manual jika belum ada cascade di database
    $property->fotos()->delete();
    $property->alamatProperty()->delete();

    // Hapus properti
    $property->delete();

    return redirect()->route('property.show')->with('success', 'Properti berhasil dihapus.');
    }
}
