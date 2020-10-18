<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'due_date',
    ];

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

    public function receipts()
    {
        return $this->hasMany('App\Models\Receipt', 'expense_id');
    }

    public function getAmountAttribute()
    {
        # code...
        return $this->transaction->credit;
    }
}
