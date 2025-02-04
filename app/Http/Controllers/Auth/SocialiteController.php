<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as ModelsSocialite;

class SocialiteController extends Controller
{
    // public function redirect()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function callback()
    // {
    //     $socialUser = Socialite::driver('google')->user();

    //     $registeredUser = User::where('google_id', $socialUser->id)->first();
    //     if (!$registeredUser){

    //         $user = User::updateOrCreate([
    //             'google_id' => $socialUser->id
    //         ],[
    //             'name' => $socialUser->name,
    //             'email' => $socialUser->email,
    //             'password' => Hash::make('123'),
    //             'google_token' => $socialUser->token,
    //             'google_refresh_token' => $socialUser->refreshToken
    //         ]);
    
    //         Auth::login($user);
    
    //         return redirect()->route('data');
    //     } 
    //     Auth::login($registeredUser);
    
    //     return redirect()->route('data');
        
    // }


    
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $authuser = $this->store($socialUser, $provider);
        Auth::login($authuser);
        return redirect()->route('data');
    }

    public function store($socialUser, $provider){
        $socialAccount = ModelsSocialite::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

        if (!$socialAccount){
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user){
                $user = User::updateOrCreate([
                    'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                ]);
            }

            $user->socialite()->create([
                'provider_id' => $socialUser->getId(),
                'provider_name' => $provider,
                'provider_token' => $socialUser->token,
                'provider_refresh_token' => $socialUser->refreshToken,
            ]);

            return $user;
        }

        return $socialAccount->user;

    }



    // public function redirect2($provider)
    // {
    //     return Socialite::driver($provider)->redirect();
    // }

    // public function callback2($provider)
    // {
    //     $socialUser = Socialite::driver($provider)->user();
    //     $authUser = $this->store($socialUser, $provider);
    //     Auth::login($authUser);
    //     return redirect()->route('data');

    // }

    // public function store($socialUser, $provider){
    //     $socialAccount = ModelsSocialite::where('provider_id', $socialUser->getId())->where('provider_name', $provider)->first();

    //     if (!$socialAccount){
    //         $user = User::where('email', $socialUser->getEmail())->first();

    //         if (!$user){
    //             $user = User::updateOrCreate([
    //                 'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname,
    //                 'email' => $socialUser->getEmail(),
    //                 'password' => bcrypt('password')
    //             ]);
    //         }

    //         $user->socialite()->create([
    //             'provider_id' => $socialUser->getId(),
    //             'provider_name' => $provider,
    //             'provider_token' => $socialUser->token,
    //             'provider_refresh_token' => $socialUser->refreshToken
    //         ]);

    //         return $user;
    //     }


    // }



}
