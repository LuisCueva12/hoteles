<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function crear()
    {
        return view('auth.login');
    }

    public function autenticar(LoginRequest $request)
    {
        $credenciales = $request->validated();
        $recordar = $request->boolean('remember');

        if (Auth::attempt($credenciales, $recordar)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.inicio'));
        }

        return back()
            ->withErrors(['email' => 'Las credenciales proporcionadas no son correctas'])
            ->onlyInput('email');
    }

    public function destruir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('inicio');
    }
}
