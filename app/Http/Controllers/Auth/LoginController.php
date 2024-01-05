<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        try {
            $credentials = request()->only(['username', 'password']);

            $cek = User::where('username', $credentials['username'])->first();

            if (!$cek) return $this->httpResponse(404, 'Username Not Found', false);

            if (Auth::attempt($credentials)) {
                // Jika autentikasi berhasil, atur session user id dan group id
                session()->put('username', Auth::user()->username);
                session()->put('group_id', Auth::user()->group_id);

                // return redirect()->intended($this->redirectTo);
                return $this->httpResponse(200, 'Login System Success', Auth::user());
            } else {
                return $this->httpResponse(401, 'Wrong Username or Password', Auth::user());
            }
        } catch (\Throwable $th) {
            return $this->httpResponse(500, $th->getMessage(), Auth::user());
        }
        // echo json_encode($request->all());
        // die;
    }
    public function onelogin($username, $password)
    {



        $credentials = [
            'username' => $username,
            'password' => $password
        ];



        $cek = User::where('username', $credentials['username'])->where('password', $credentials['password'])->first();




        if ($cek) {
            Auth::login($cek);
            // Jika autentikasi berhasil, atur session user id dan group id
            session()->put('username', $cek->username);
            session()->put('group_id', $cek->group_id);

            return redirect()->intended($this->redirectTo);
        } else {
            return redirect('/');
        }
    }


    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
