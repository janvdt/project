<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\Auth\LoginRequest; 
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{

    /**
     * User model instance
     * @var User
     */
    protected $user; 
    
    /**
     * For Guard
     *
     * @var Authenticator
     */
    protected $auth;

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user; 
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /* Login get post methods */
    protected function getLogin() {
        return View('login.login');
    }

    protected function postLogin(LoginRequest $request) {
        if ($this->auth->attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }
 
        return redirect('users/login')->withErrors([
            'email' => 'The email or the password is invalid. Please try again.',
        ]);
    }

    /* Register get post methods */
    protected function getRegister() {
        return View('login.register');
    }

    protected function postRegister(RegisterRequest $request) {
        $this->user->name = $request->name;
        $this->user->email = $request->email;
        $this->user->password = bcrypt($request->password);
        $this->user->save();
        return redirect('users/login');
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    protected function getLogout()
    {
        $this->auth->logout();
        return redirect('login/login');
    }
}