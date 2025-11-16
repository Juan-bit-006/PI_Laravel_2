<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'role'         => 'required|string',
            'estado_login' => 'required|boolean',
        ]);

        User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'estado_login' => $request->estado_login,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'role'         => 'required|string',
            'estado_login' => 'required|boolean',
        ]);

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->role         = $request->role;
        $user->estado_login = $request->estado_login;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }

    public function exportPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView('users.pdf', compact('users'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('reporte_logins_' . now()->format('Ymd_His') . '.pdf');
    }
}
