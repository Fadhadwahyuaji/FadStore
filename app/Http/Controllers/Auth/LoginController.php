<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/beranda';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Override the authenticated method to redirect based on user role
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect('/data-produk');
        } elseif ($user->role === 'pembeli') {
            return redirect('/beranda');
        }

        return redirect($this->redirectTo);
    }
}
