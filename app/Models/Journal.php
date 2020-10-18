<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the account that owns the journal entry.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

    /**
     * Get the transaction that owns the journal entry.
     */
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
