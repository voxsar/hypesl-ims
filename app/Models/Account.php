<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the journals for the account post.
     */
    public function journals()
    {
    	# code...
        return $this->hasMany('App\Models\Journal');
    }

    public function subaccounts()
    {
        # code...
        return $this->hasMany('App\Models\Account', 'account_id');
    }

    public static function receivable()
    {
        return Account::firstOrCreate(
            ['name' => 'Accounts Receivable'], 
            ['type' => 'Assets']
        );
    }

    public static function payable()
    {
        return Account::firstOrCreate(
            ['name' => 'Accounts Payable'], 
            ['type' => 'Liabilities']
        );
    }

    /**
     * Scope a query to only include income accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIncome($query)
    {
        return $query->where('type', 'Income');
    }

    /**
     * Scope a query to only include expenses accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpenses($query)
    {
        return $query->where('type', 'Expenses');
    }

    /**
     * Scope a query to only include assets accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssets($query)
    {
        return $query->where('type', 'Assets');
    }

    /**
     * Scope a query to only include equity accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEquity($query)
    {
        return $query->where('type', 'Equities');
    }

    /**
     * Scope a query to only include liabilities accounts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLiabilities($query)
    {
        return $query->where('type', 'Liabilities');
    }
}
