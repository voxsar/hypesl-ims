<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class MessageTopic extends Model
{
    use HasFactory;
    use Searchable;

    public $asYouType = true;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['updated_at_human'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

    public function getUpdatedAtHumanAttribute()
    {
        # code...
        return $this->updated_at->diffForHumans();
    }

    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'messagetopicable');
    }

    public function contacts()
    {
        return $this->morphedByMany('App\Models\Contact', 'messagetopicable');
    }

    public function messages()
    {
        # code...
        return $this->hasMany('App\Models\Message', 'message_topic_id');
    }
}
