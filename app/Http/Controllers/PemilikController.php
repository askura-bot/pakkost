<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $users = User::all(); // ambil semua user
        return view('content.pemilik.dashboard', compact('users'));
    }
}
