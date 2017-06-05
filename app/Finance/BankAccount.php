<?php

namespace Bookkeeper\Finance;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Kenarkose\Sortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;

class BankAccount extends Eloquent
{

    use Sortable, SearchableTrait;

protected $table = 'bankaccounts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'currency'
    ];

    /**
     * Sortable columns
     *
     * @var array
     */
    protected $sortableColumns = ['name', 'currency', 'created_at'];

    /**
     * Default sortable key
     *
     * @var string
     */
    protected $sortableKey = 'name';

    /**
     * Default sortable direction
     *
     * @var string
     */
    protected $sortableDirection = 'asc';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'currency' => 10
        ]
    ];

    /**
     * Transaction relation
     *
     * @return BelongsToMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Returns the company balance
     *
     * @return float
     */
    public function getBalance()
    {
        $incomes = $this->transactions
            ->where('type', 'income');
        $expenses = $this->transactions
            ->where('type', 'expense');

        return $incomes->sum('amount') - $expenses->sum('amount');
    }

}
