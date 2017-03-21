<?php namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Routing\Controller;

class AuthRadiusController extends Controller {

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {   
        dd(get_loaded_extensions());
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect()->intended('dashboard');
        }
    }

}