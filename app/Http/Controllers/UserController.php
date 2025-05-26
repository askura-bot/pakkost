<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
    $query = Property::with([
        'pemilik.alamat',
        'fotos', 
        'ulasans',
        'alamatProperty',
        'fasilitas'
    ]);

    // Tambahkan pencarian nama properti
    if ($request->has('search')) {
        $searchTerm = '%' . $request->search . '%';
        $query->where('nama_properti', 'like', $searchTerm);
    }

    // Filter Harga
    if ($request->min_harga) {
        $query->where('harga', '>=', $request->min_harga);
    }
    if ($request->max_harga) {
        $query->where('harga', '<=', $request->max_harga);
    }

    // Filter Alamat (Relasi AlamatProperty)
    $query->whereHas('alamatProperty', function($q) use ($request) {
        if ($request->kelurahan) {
            $q->where('kelurahan', 'like', '%'.$request->kelurahan.'%');
        }
        if ($request->jalan) {
            $q->where('jalan', 'like', '%'.$request->jalan.'%');
        }
        if ($request->rt) {
            $q->where('rt', $request->rt);
        }
        if ($request->rw) {
            $q->where('rw', $request->rw);
        }
    });

    // Filter Fasilitas (Many-to-Many)
    if ($request->fasilitas) {
        $query->whereHas('fasilitas', function($q) use ($request) {
            $q->whereIn('fasilitas.id', $request->fasilitas);
        }, '>=', count($request->fasilitas));
    }

    $properties = $query->get();
    $fasilitasOptions = Fasilitas::all(); // Untuk dropdown/checkbox

    return view('content.user.index', compact('properties', 'fasilitasOptions'));
    }

    public function contact()
    {
    $contact = Contact::first();
    return view('content.user.contact', compact('contact'));
    }

    public function show(Property $property)
    {
    $property->load([
        'pemilik.alamat',
        'fotos',
        'fasilitas',
        'alamatProperty',
        'ulasans' => function($query) {
            $query->orderBy('created_at', 'desc'); // Urutkan dari yang terbaru
        }
    ]);
    
    return view('content.user.detail-property', compact('property'));
    }

    public function storeUlasan(Request $request, Property $property)
    {
    $validatedData = $request->validate([
        'rating' => 'nullable|integer|min:0|max:5',  // Diubah menjadi nullable
        'komentar' => 'required|string|max:500',
        'username' => 'required|string|max:255',
    ]);

    $property->ulasans()->create([
        'username' => $validatedData['username'],
        'rating' => $validatedData['rating'] ?? 0,  // Default 0 jika tidak ada rating
        'komentar' => $validatedData['komentar']
    ]);

    return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
