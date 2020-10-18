<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;
    //
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'extendedprops' => 'array',
        'daysofweek' => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end',
        'starttime',
        'endtime',
        'startrecur',
        'endrecur',
    ];

    public function team()
    {
        # code...
        return $this->belongsTo('App\Models\Team');
    }

    public function contacts()
    {
        # code...
        return $this->belongsToMany('App\Models\Contact');
    }

    public function group()
    {
        # code...
        return $this->belongsTo("App\Models\AppointmentGroup");
    }
}
