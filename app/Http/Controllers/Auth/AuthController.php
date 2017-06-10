<?php

namespace Bookkeeper\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Bookkeeper\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{

    //ThrottlesLogins
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->redirectTo = route('bookkeeper.overview');
    }

}
