<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
    $user = $request->user();

    $validated = $request->validated();

    if ($request->email !== $user->email) {
        $user->email_verified_at = null;
    }

    $user->fill([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'no_wa' => $validated['no_wa'] ?? null,
        
    ]);

    $user->save();

    $user->alamat()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'kelurahan' => $validated['kelurahan'],
            'jalan' => $validated['jalan'],
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
        ]
    );

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
