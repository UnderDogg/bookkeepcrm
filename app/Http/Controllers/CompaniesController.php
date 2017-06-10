<?php


namespace Bookkeeper\Http\Controllers;


use Bookkeeper\Http\Controllers\Traits\BasicResource;
use Bookkeeper\Bookkeeping\Company;
use Bookkeeper\Http\Controllers\Traits\UsesCompanyForms;
use Bookkeeper\Support\Currencies\Cruncher;
use Carbon\Carbon;

class CompaniesController extends BookkeeperController
{

    use BasicResource, UsesCompanyForms;

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
    /*public function transactions($id)
    {
        $company = Company::findOrFail($id);

        $transactions = $company->transactions()
            ->sortable()->paginate();

        return $this->compileView('companies.transactions', compact('company', 'transactions'), trans('transactions.title'));
    }*/

    /**
     * Shows overview for the company.
     *
     * @param int $id
     * @return Response
     */
    public function overview($id)
    {
        $company = Company::findOrFail($id);

        $start = Carbon::now()->endOfMonth()->subYear()->addSecond();
        $end = Carbon::now()->endOfMonth();

        /*$transactions = $company->transactions()
            ->whereReceived(1)
            ->whereBetween('created_at', [$start, $end])
            ->get();*/

        /*$statistics = (new Cruncher())
            ->compileAccountStatisticsFor($transactions, $company, $start, $end);*/
        //'statistics'

        return $this->compileView('companies.overview', compact('company'), trans('overview.index'));
    }

}