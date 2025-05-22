<?php

namespace App\Http\Controllers;

use App\Models\AlamatUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatUserController extends Controller
{
    public function edit()
    {
        $alamat = Auth::user()->alamat;
        return view('profile.edit-alamat', compact('alamat'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kelurahan' => 'required|string|max:255',
            'jalan' => 'required|string|max:255',
            'RW' => 'required|string|max:255',
            'RT' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $user->alamat->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['kelurahan', 'jalan', 'RW', 'RT'])
        );

        return redirect()->back()->with('status', 'Alamat berhasil diperbarui.');
    }
}
