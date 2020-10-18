<?php

namespace App\Models;

use Log;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Http;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'oname', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function socialitetokens()
    {
        # code...
        return $this->hasMany('App\Models\SocialiteToken');
    }

    /**
     * Get all of the tags for the post.
     */
    public function messagetopics()
    {
        return $this->morphToMany('App\Models\MessageTopic', 'messagetopicable');
    }

    public function messages()
    {
        return $this->morphMany('App\Models\Message', 'messageable');
    }

    public function googleToken()
    {
        # code...
        $google = $this->socialitetokens()->where('type', 'Google')->first();
        if(is_null($google)){
            return null;
        }else{
            if($google->nextRefresh->lessThan(Carbon::now())){
                $response = Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => config("services.google.client_id"),
                    'client_secret' =>  config("services.google.client_secret"),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $google->refreshToken,
                ]);
                Log::info($response);
                $google->token = $response['access_token'];
                $google->expiresIn = $response['expires_in'];
                $google->save();
                return $google->token;
            }
        }
    }

    public function microsoftToken()
    {
        # code...
        $microsoft = $this->socialitetokens()->where('type', 'Microsoft')->first();
        if(is_null($microsoft)){
            return 0;
        }else{
            if($microsoft->nextRefresh->lessThan(Carbon::now())){
               /* $response = Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => config("services.microsoft.client_id"),
                    'client_secret' =>  config("services.microsoft.client_secret"),
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $microsoft->refreshToken,
                ]);
                Log::info($response);
                $microsoft->token = $response->access_token;
                $microsoft->expiresIn = $response->expires_in;
                $microsoft->save();*/
                return $microsoft->token;
            }
        }
    }
}
