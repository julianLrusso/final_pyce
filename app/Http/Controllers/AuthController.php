<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra la pantalla de login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Inicia la sesión
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return redirect()
                ->route('auth.showLogin')
                ->with('alert.message', 'Las credenciales no coinciden.')
                ->withInput();
        }

        return redirect()->route('home')->with('feedback.message', 'Inicio de sesión correcto');
    }

    /**
     * Muestra la página del registro
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Registra al usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doRegister(Request $request)
    {
        $request->validate(User::VALIDATION_RULES, User::VALIDATION_MESSAGES);
        $data = $request->except(['_token', 'password_confirmation']);

        // Hasheo la password acá pero creo que en el model hace un cast y lo hashea automáticamente
        $data['password'] = Hash::make($request->get('password'));

        User::create($data);
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('feedback.message', 'Registro correcto');
        }

        return redirect()->route('home')->with('alert.message', 'Algo falló. Intente nuevamente');
    }

    /**
     * Cierra la sesión
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.showLogin')->with('feedback.message', 'Sesión cerrada correctamente. Vuelva pronto');
    }

}
