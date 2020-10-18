<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['messenger_name', 'initial', 'time'];

    public function topic()
    {
    	# code...
    	return $this->belongsTo('App\Models\MessageTopic', 'message_topic_id');
    }

    /**
     * Get the owning messageable model.
     */
    public function messageable()
    {
        return $this->morphTo();
    }

    public function getMessengerNameAttribute()
    {
    	# code...
    	return $this->messageable->fname." ".$this->messageable->lname;
    }

    public function getInitialAttribute()
    {
    	# code...
    	return ucfirst(substr($this->messageable->fname, 0, 1)).ucfirst(substr($this->messageable->lname, 0, 1));
    }

    public function getTimeAttribute()
    {
    	return $this->created_at->format('h:i');
    }
}
