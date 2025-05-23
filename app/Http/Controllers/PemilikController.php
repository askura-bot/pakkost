<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikController extends Controller
{
    public function index()
    {
        // Ambil properti milik user yang sedang login
        $properties = Auth::user()->properties()
                        ->withCount('fotos')
                        ->latest()
                        ->get();

        return view('content.pemilik.dashboard', [
            'properties' => $properties,
            'total_properti' => $properties->count()
        ]);
    }

    public function show()
    {
        // Pastikan hanya pemilik yang boleh mengakses
        // if (Auth::user()->role !== 'pemilik') {
        //     abort(403, 'Akses ditolak');
        // }

        $properties = Property::with(['fotos'])
            ->where('user_id', Auth::id())
            ->get();

        return view('content.pemilik.propertie', compact('properties'));
    }

    public function edit(Property $property)
    {
        // Cek kepemilikan properti
        // if ($property->user_id !== Auth::id()) {
        //     abort(403, 'Akses ditolak');
        // }

        // Load semua relasi yang dibutuhkan untuk edit
        // $property->load(['fotos', 'alamatProperty', 'fasilitas']);

        // return view('edit_property', compact('property'));
    }
}
