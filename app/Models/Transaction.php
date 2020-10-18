<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['debit', 'credit'];

    /**
     * Get the owning transactionable model.
     */
    public function transactionable()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        # code...
        switch ($this->transactionable->getMorphClass()) {
            case 'App\Models\Expense':
                    return "Expense";
                break;
            case 'App\Models\Receipt':
                    return "Receipt";
                break;
            case 'App\Models\Invoice':
                    return "Invoice";
                break;
            case 'App\Models\Payment':
                    return "Payment";
                break;
            
            default:
                    return "Custom Transaction";
                break;
        }
    }

    /**
     * Get the journals for the transaction post.
     */
    public function journals()
    {
    	# code...
        return $this->hasMany('App\Models\Journal', 'transaction_id');
    }

    public function getDebitAttribute()
    {
    	return $this->journals->sum('debit');
    }

    public function getCreditAttribute()
    {
    	return $this->journals->sum('credit');
    }
}
