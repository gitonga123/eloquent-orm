<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $data = Socialite::with('facebook')->redirect();
        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            Auth::login($user);

            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        } else {
           $user = User::where('facebook_id', $data->id)->first();
           if (is_null($user)) {
               //create a new user
               $user = new User();
               $user->name = $data->user['name'];
               $user->email = $data->email;
               $user->facebook_id = $data->id;
               $user->save();
           }
            Auth::login($user);
        }

        return redirect('/home')->with('success', 'Successfully Logged in!');
    }

//    public function login(Request $request)
//    {
//        $this->validateLogin($request);
//
//        if ($this->attemptLogin($request)) {
//            $user = $this->guard()->user();
//            $user->generateToken();
//            return response()->json(['data' => $user->toArray()]);
//        }
//
//        return $this->sendFailedLoginResponse($request);
//    }
//
//    public function logout(Request $request)
//    {
//        $user = Auth::guard('api/vi')->user();
//
//        if ($user) {
//            $user->api_token = null;
//            $user->save();
//        }
//
//        return response()->json(['data' => 'User logged out.'], 200);
//    }
}
