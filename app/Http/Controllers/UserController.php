<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Property $property)
    {
        $properties = Property::with([
            'pemilik.alamat',
            'fotos',
            'ulasans', 
            'alamatProperty',
            'fasilitas'
        ])->get();

        return view('content.user.index', compact('properties'));
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
            'ulasans'
        ]);
    
    return view('content.user.detail-property', compact('property'));
    }

    public function storeUlasan(Request $request, Property $property)
    {
    $validatedData = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string|max:500',
        'username' =>  'required|string|max:255',
    ]);

    

    $property->ulasans()->create([
        'username' => $validatedData['username'],
        'rating' => $validatedData['rating'],
        'komentar' => $validatedData['komentar']
    ]);

    return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }
}
