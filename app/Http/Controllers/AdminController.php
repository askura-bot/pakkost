<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Contact;
use App\Models\Property;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    $stats = [
        'propertiesCount' => Property::count(),
        'ownersCount' => User::where('role', 'pemilik')->count(),
        'adminsCount' => User::where('role', 'admin')->count(),
        'contactsCount' => Contact::count(),
        'fasilitasCount' => Fasilitas::count(),
        'recentProperties' => Property::with('pemilik')
            ->latest()
            ->limit(10)
            ->get()
    ];

    return view('content.admin.dashboard', $stats);
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

    return view('content.admin.detail', compact('property'));
    }

    public function owner()
    {
        $pemilik = User::where('role', 'pemilik')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('content.admin.owner', compact('pemilik'));
    }

    public function detail(User $user)
    {
    // Load user dengan relasi properti
    $user->load(['properties' => function($query) {
        $query->latest();
    }]);

    return view('content.admin.detail-owner', compact('user'));
    }

    public function admin()
    {
    $admins = User::where('role', 'admin')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('content.admin.admin', compact('admins'));
    }

    public function create()
    {
        return view('content.admin.create-akun');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
        'no_wa' => 'required|regex:/^08[0-9]{9,12}$/',
        'role' => 'required|in:admin,pemilik',
        'alamat.jalan' => 'required|string',
        'alamat.kelurahan' => 'required|string',
        'alamat.rt' => 'required|integer|min:1',
        'alamat.rw' => 'required|integer|min:1',
    ]);

    $user = User::create($validated);
    $user->alamat()->create($validated['alamat']);

    return redirect()->route('create.user')->with('success', 'User berhasil ditambahkan');
    }
}
