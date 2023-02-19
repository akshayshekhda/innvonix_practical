<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserRoleModel;

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
    /**
     *|--------------------------
     *| Login form
     *|--------------------------
     *|
    */
    public function showLoginForm()
    {
        $UserRoleData = UserRoleModel::get();
        return view('auth.login',compact('UserRoleData'));
    }
    /*
    *|----------------------------
    *| Login credinational Check
    *|-----------------------------
    *|
    */
    public function LoginCheck(Request $request)
    {

      $input = $request->all();

        
        $users = User::where(['email' => $input['email']])->first();
        if (!empty($users)) {
                $passCheck = Hash::check($input['password'], $users->password);

                if ($passCheck == true) {
                    if ($passCheck) {
                        $input = ['email' => $users->email, 'password' => $input['password']];
                        if (Auth::guard('web')->attempt($input)) {
                                return redirect()->route('projectlist.index')->with('success', 'Logged in.');
                        }
                    } else {
                        return redirect::back()->with('password', 'Password does not match.')->withInput();
                    }
                } else {
                    return back()->with('danger', 'Password does not match.');
                }
        } else {
            return redirect::back()->with('danger', 'Email does not exists with system.');
        }
    }
    public function logout()
    {

        $AuthUser = Auth::guard('web')->user();
        Auth::logout('web');
        return redirect()->route('home');
    }
}