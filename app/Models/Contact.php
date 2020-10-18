<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Contact extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    use HasApiTokens;
    //
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'other' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get all of the invoiceable items.
     */
    public function invoices()
    {
        return $this->morphToMany('App\Models\Invoice', 'invoiceable');
    }

    /**
     * Get all of the receivable items.
     */
    public function receipts()
    {
        return $this->morphToMany('App\Models\Payment', 'receivable');
    }
    
    public function relations()
    {
        # code...
        return $this->belongsToMany('App\Models\Contact', 'contact_relationships', 'contact_id', 'related_contact_id')
            ->using('App\Models\ContactRelationship')
            ->withPivot([
                'created_at',
                'updated_at',
                'contact_relationship_type_id'
            ]);
    }

    public function appointments()
    {
        # code...
        return $this->belongsToMany('App\Models\Appointment');
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
}
