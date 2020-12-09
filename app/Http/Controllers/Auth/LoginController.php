<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

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
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        // if (Auth::user()->usertype == 'admin') {
        //     return 'dashboard';
        // } else if (Auth::user()->usertype == 'null') {
        //     return 'welcome';
        // } else if (Auth::user()->usertype == 'user') {
        //     return 'welcome';
        // }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $uname = $request->input('username');
        $password = $request->input('password');
        // $hasmake_password = Hash::make($password);
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];
        //  print_r($credentials);

        $this->validate(
            $request,
            array(
                'username' => 'required',
                'password' => 'required',
            ),
        );
        $isuser = 0;
        //echo $uname;
        $userinfo = DB::table('users')
            ->select('*')
            ->where([['username', $uname], ['active', 1]])
            ->get();

        $logintype = 0;
        foreach ($userinfo as $uinfo) {
            // echo $uinfo->name;
            $isuser = 1;
            $logintype = $uinfo->logintype;
            $makepassword = $uinfo->password;
            $userprofile = array("id" => $uinfo->id, "logintype" => $logintype);
        }

        if ($isuser == 1) {
            // ad or db

            if ($logintype == 1) {
                // check ad
                // Auth::loginUsingId($uinfo->id, TRUE); //AD 
                if (Auth::loginUsingId($uinfo->id, TRUE)) {
                    if (Auth::user()->usertype == 'admin') {
                        return redirect()->intended('dashboard');
                    } else if (Auth::user()->usertype == 'user') {
                        return redirect()->intended('dashboarduser');
                    } else{
                        return redirect()->back();
                    }
                }
            } else if ($logintype == 0) {
                // $credentials = $request->only('username', 'password');
                // print_r($credentials);
                if (Auth::attempt($credentials)) {
                    if (Auth::user()->usertype == 'admin') {
                        return redirect()->intended('dashboard');
                    } else if (Auth::user()->usertype == 'user') {
                        return redirect()->intended('dashboarduser');
                    }else{
                        return redirect()->back();
                    }
                } else{
                    return redirect()->back();
                }
                // else{
                //     return redirect()->back();
                // }
            }
        } else {
            return redirect()->back()->with('status','Username or Password incorrect');
        }
    }
}
