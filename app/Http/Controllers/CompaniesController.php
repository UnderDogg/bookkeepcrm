<?php


namespace Bookkeeper\Http\Controllers;


use Bookkeeper\Http\Controllers\Traits\BasicResource;
use Bookkeeper\Bookkeeping\Company;
use Bookkeeper\Http\Controllers\Traits\UsesAccountForms;
use Bookkeeper\Support\Currencies\Cruncher;
use Carbon\Carbon;

class CompaniesController extends BookkeeperController
{

    use BasicResource, UsesAccountForms;

    /**
     * Self model path required for ModifiesPermissions
     *
     * @var string
     */
    protected $modelPath = Company::class;
    protected $resourceMultiple = 'companies';
    protected $resourceSingular = 'company';

    /**
     * Shows transactions for the company.
     *
     * @param int $id
     * @return Response
     */
    public function transactions($id)
    {
        $bankaccount = Company::findOrFail($id);

        $transactions = $bankaccount->transactions()
            ->sortable()->paginate();

        return $this->compileView('companies.transactions', compact('company', 'transactions'), trans('transactions.title'));
    }

    /**
     * Shows overview for the company.
     *
     * @param int $id
     * @return Response
     */
    public function overview($id)
    {
        $bankaccount = Company::findOrFail($id);

        $start = Carbon::now()->endOfMonth()->subYear()->addSecond();
        $end = Carbon::now()->endOfMonth();

        $transactions = $bankaccount->transactions()
            ->whereReceived(1)
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $statistics = (new Cruncher())
            ->compileAccountStatisticsFor($transactions, $bankaccount, $start, $end);

        return $this->compileView('companies.overview', compact('company', 'statistics'), trans('overview.index'));
    }

}