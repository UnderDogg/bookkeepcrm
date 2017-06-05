<?php


namespace Bookkeeper\Http\Controllers;


use Bookkeeper\Http\Controllers\Traits\BasicResource;
use Bookkeeper\Finance\BankAccount;
use Bookkeeper\Http\Controllers\Traits\UsesAccountForms;
use Bookkeeper\Support\Currencies\Cruncher;
use Carbon\Carbon;

class BankAccountsController extends BookkeeperController
{

    use BasicResource, UsesAccountForms;

    /**
     * Self model path required for ModifiesPermissions
     *
     * @var string
     */
    protected $modelPath = BankAccount::class;
    protected $resourceMultiple = 'bankaccounts';
    protected $resourceSingular = 'bankaccount';

    /**
     * Shows transactions for the company.
     *
     * @param int $id
     * @return Response
     */
    public function transactions($id)
    {
        $bankaccount = BankAccount::findOrFail($id);

        $transactions = $bankaccount->transactions()
            ->sortable()->paginate();

        return $this->compileView('companies.transactions', compact('bankaccount', 'transactions'), trans('transactions.title'));
    }

    /**
     * Shows overview for the company.
     *
     * @param int $id
     * @return Response
     */
    public function overview($id)
    {
        $bankaccount = BankAccount::findOrFail($id);

        $start = Carbon::now()->endOfMonth()->subYear()->addSecond();
        $end = Carbon::now()->endOfMonth();

        $transactions = $bankaccount->transactions()
            ->whereReceived(1)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $statistics = (new Cruncher())
            ->compileAccountStatisticsFor($transactions, $bankaccount, $start, $end);

        return $this->compileView('bankaccounts.overview', compact('bankaccount', 'statistics'), trans('overview.index'));
    }

}