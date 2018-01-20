<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;

class OAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // todo $this->middleware('guest')->except('logout');
    }

    /**
     * 跳转到 $driver 对应的登录页面登录
     * 本网站只实现了 GitHub 登录
     * @param $driver
     * @return mixed
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        $user = Socialite::driver($driver)->user();
        // $user->token;
    }
}
