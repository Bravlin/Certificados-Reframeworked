<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdministradorController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    protected $redirectAfterLogout = '/administradores/login';

    protected function guard()
    {
        return Auth::guard('administrador');
    }

    public function showLoginForm()
    {
        return view('administradores.login');
    }

    protected function loggedOut(Request $request) {
        return redirect($this->redirectAfterLogout);
    }
}
