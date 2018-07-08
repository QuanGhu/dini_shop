<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    protected function authenticated(Request $request, $user)
    {
        if($user->role_id == 1) {
            return false;
        } elseif($user->role_id == 2) {
            return false;
        }
        else {
            $this->guard()->logout();
            return redirect()->route('login')->withErrors('Restricted Area');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        return redirect()->route('login');
    }

    public function loginForMobile(Request $request)
    {
        try {
            if(Auth::attempt(['email' => $request->email,'password' => $request->password,'role_id' => 3]))
            {
                $user = Auth::user();
                $token = $user->createToken('MyApp')->accessToken;

                return response()->json(['success'=>True, 'token' => 'Bearer '.$token], 200);
            } else {
                return response()->json(['success'=>False, 'message' => 'invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['success'=>False, 'message' => $e->getMessage()], 400);
        }
    }
}
