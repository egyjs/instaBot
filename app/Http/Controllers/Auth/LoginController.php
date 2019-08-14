<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        unset($_COOKIE);
        return redirect('/');
    }
    public function login(Request $request){
        $this->validateLogin($request);
        $useragent = generate_useragent();
        $device_id = generate_device_id();

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $login = proccess(1, $useragent, 'accounts/login/', 0, hook('{"device_id":"' . $device_id . '","guid":"' . generate_guid() . '","username":"' . $request->username . '","password":"' . $request->password . '","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}'), array(
            'Accept-Language: id-ID, en-US',
            'X-IG-Connection-Type: WIFI'
        ));

        if(json_decode($login[1])->status == 'ok') {
            save_cookie($login[0],json_encode(json_decode($login[1])));
            $userid = User::where('username',$request->username)->first();
//            exit(var_dump($userid));
            if ($userid != null){
                if(Auth::loginUsingId($userid->id)) {

                    return response()->json([
                        "url"=>$this->redirectTo,
                    ],200);
                }
            }else{
//                exit(var_dump(InstaUser()->username));
                $user = new User();
                $user->role_id = 2;
                $user->username = InstaUser()->username;
                $user->password = $request->password;
                $user->avatar = InstaUser()->profile_pic_url;
                dd(InstaUser()->pk);
                $user->settings = "{'pk':'".InstaUser()->pk."' }";

                $user->save();

                Auth::loginUsingId($user->id);
                return response()->json([
                    "url"=>$this->redirectTo,
                ],200);
            }
        }else{
            $this->incrementLoginAttempts($request);
            return response()->json([
                'error' => 'Sorry, your password or username was incorrect. Please double-check.',
                'log' =>json_decode($login[1])
            ], 401);
        }
    }
}
