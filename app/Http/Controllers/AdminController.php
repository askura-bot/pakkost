<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Property;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
    $stats = [
        'propertiesCount' => Property::count(),
        'ownersCount' => User::where('role', 'pemilik')->count(),
        'adminsCount' => User::where('role', 'admin')->count(),
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
        'ulasans'
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
}
