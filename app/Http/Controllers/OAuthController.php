<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Services\ImageService;
use Carbon\Carbon;
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
        return Socialite::driver($driver)->stateless()->redirect();
    }

    public function handleProviderCallback($driver)
    {
        /**
         * @var \Laravel\Socialite\Two\User $user
         */
        $user = Socialite::driver($driver)->stateless()->user();
        $username = $user->offsetGet('login');
        $userModel = User::where('username', $username)->first();
        if (is_null($userModel)) {
            $image = app(ImageService::class)->store($user->getAvatar());
            // 注册
            $userModel = User::create([
                'username' => $username,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'github_url' => $user->offsetGet('html_url'),
                'avatar_hash' => $image->hash,
                'last_active_at' => Carbon::now()
            ]);
            Image::where('hash', $image->hash)->update(['creator_id' => $userModel->id]);
        }

        $token = $this->guard()->login($userModel);
        return view('logging', ['access_token' => $token, 'expires_in' => $this->guard()->factory()->getTTL() * 60, 'user' => $userModel]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
