<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactRelationship extends Pivot
{
    use HasFactory;
    use SoftDeletes;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = "contact_relationships";
    
    //
    public function client()
    {
    	# code...
    	return $this->belongsToMany('App\Models\Contact', 'contact_id');
    }
    
    public function relations()
    {
    	# code...
    	return $this->belongsToMany('App\Models\Contact', 'related_contact_id');
    }

    public function type()
    {
        # code...
        return $this->belongsTo('App\Models\ContactRelationshipType');
    }
}