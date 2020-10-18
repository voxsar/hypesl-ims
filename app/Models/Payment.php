<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['amount'];
    
    /**
     * Get the invoice's transaction.
     */
    public function transaction()
    {
        return $this->morphOne('App\Models\Transaction', 'transactionable');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }

    public function getAmountAttribute()
    {
        # code...
        return $this->transaction->debit;
    }
}
