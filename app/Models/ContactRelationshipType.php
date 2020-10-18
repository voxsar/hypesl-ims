<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactRelationshipType extends Model
{
    use HasFactory;
    use SoftDeletes;
    //
    public function relations()
    {
    	# code...
    	return $this->hasMany('App\Models\ContactRelationship');
    }
}
