<?php

namespace App\Http\Controllers;

use Auth;
use Log;
use Carbon\Carbon;
use App\Models\SocialiteToken;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Http;

class SocialiteTokenController extends Controller
{
    //
    public function redirectToGoogleProvider()
    {
        # code...
        return Socialite::driver('google')
            ->with([
                'access_type' => 'offline'
            ])
            ->scopes([
                'https://www.googleapis.com/auth/contacts',
                'https://www.googleapis.com/auth/calendar'
            ])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleProviderCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $socialiteToken = new SocialiteToken();
        $socialiteToken->type = "Google - Intermediate";
        $socialiteToken->token = $user->token;
        $socialiteToken->refreshToken = $user->refreshToken;
        $socialiteToken->expiresIn = $user->expiresIn;
        $socialiteToken->oauthId = $user->getId();
        $socialiteToken->user_id = Auth::id();
        $socialiteToken->nextRefresh = Carbon::now()->addSeconds($user->expiresIn);
        $socialiteToken->save();

		$response = Http::post('https://oauth2.googleapis.com/token', [
            'client_id' => config("services.google.client_id"),
            'client_secret' =>  config("services.google.client_secret"),
		    'code' => $request->code,
		    'grant_type' => 'authorization_code',
		    'redirect_uri' => 'https://beta.anykindonline.com/login/google/callback',
		]);

        $socialiteFinal = new SocialiteToken();
        $socialiteFinal->type = "Google";
        $socialiteFinal->token = $response['access_token'];
        $socialiteFinal->refreshToken = $response['id_token'];
        $socialiteFinal->expiresIn = $response['expires_in'];
        $socialiteFinal->oauthId = $response['id_token'];
        $socialiteFinal->user_id = Auth::id();
        $socialiteFinal->nextRefresh = Carbon::now()->addSeconds($response['expires_in']);
        $socialiteFinal->save();

        return redirect('appointments');
    }

    public function redirectToMicrosoftProvider()
    {
        # code...
        return Socialite::driver('microsoft')
            ->scopes([
                'openid',
                'profile',
                'offline_access',
                'user.read',
                'mailboxsettings.read',
                'calendars.readwrite'
            ])
            ->redirect();
    }

    public function handleMicrosoftProviderCallback(Request $request)
    {
        # code...
        $user = Socialite::driver('microsoft')->user();
        $socialiteToken = new SocialiteToken();
        $socialiteToken->type = "Microsoft - Intermediate";
        $socialiteToken->token = $user->token;
        $socialiteToken->refreshToken = $user->refreshToken;
        $socialiteToken->expiresIn = $user->expiresIn;
        $socialiteToken->oauthId = $user->getId();
        $socialiteToken->user_id = Auth::id();
        $socialiteToken->nextRefresh = Carbon::now()->addSeconds($user->expiresIn);
        $socialiteToken->save();
        Log::info($request);

        $response = Http::post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
            'client_id' => config("services.microsoft.client_id"),
            'client_secret' =>  config("services.microsoft.client_secret"),
            'grant_type' => 'authorization_code',
            'code' => $request->code,
            'scope' => 'openid profile offline_access user.read mailboxsettings.read calendars.readwrite',
            'redirect_uri' => config("services.microsoft.redirect"),
            'tenant' => 'common',
        ]);

        Log::info($response->body());
        $socialiteFinal = new SocialiteToken();
        $socialiteFinal->type = "Microsoft";
        $socialiteFinal->token = $response['access_token'];
        $socialiteFinal->refreshToken = $response['refresh_token'];
        $socialiteFinal->expiresIn = $response['expires_in'];
        $socialiteFinal->oauthId = $response['id_token'];
        $socialiteFinal->user_id = Auth::id();
        $socialiteFinal->nextRefresh = Carbon::now()->addSeconds($response['expires_in']);
        $socialiteFinal->save();

        return redirect('appointments');
    }
}
