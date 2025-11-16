<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'password'              => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta']);
        }

        $user->delete();

        return redirect('/');
    }
}
