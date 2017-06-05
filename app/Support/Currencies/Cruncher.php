<?php


namespace Bookkeeper\Support\Currencies;


use Bookkeeper\Finance\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class Cruncher
{

    /**
     * Crunches transactions for given transactions
     *
     * @param Collection $transactions
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public function compileStatisticsFor(Collection $transactions, Carbon $start, Carbon $end)
    {
        list($statistics, $labels) = $this->getNewBaseForInterval($start, $end);

        $companies = $transactions->groupBy('company_id');
        $bankaccounts = $transactions->groupBy('bankaccount_id');

        $companyId = get_default_company();


        foreach ($bankaccounts as $bankaccountId => $transactions) {
            $rate = app('bookkeeper.support.currency')->getRateFor($companyId, $bankaccountId);

            $statistics = $this->mergeTransactionsWith($transactions, $statistics, $rate);
        }

        $summary = $this->generateSummary($statistics, get_default_bankaccount());
        $statistics = $this->normalizeStatistics($statistics, get_default_bankaccount());

        return array_merge($summary, compact('statistics', 'labels'));
    }

    /**
     * Crunches transactions for an company
     *
     * @param Collection $transactions
     * @param Company $bankaccount
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    public function compileAccountStatisticsFor(Collection $transactions, Company $bankaccount, Carbon $start, Carbon $end)
    {
        list($statistics, $labels) = $this->getNewBaseForInterval($start, $end);

        $statistics = $this->mergeTransactionsWith($transactions, $statistics, 1);

        $summary = $this->generateSummary($statistics, $bankaccount->getKey());
        $statistics = $this->normalizeStatistics($statistics, $bankaccount->getKey());

        return array_merge($summary, compact('statistics', 'labels'));
    }

    /**
     * Generates base template for statistics with given interval
     *
     * @param Carbon $start
     * @param Carbon $end
     * @return array
     */
    protected function getNewBaseForInterval(Carbon $start, Carbon $end)
    {
        $months = [];
        $labels = [];

        while ($start->lt($end)) {
            $months[$start->month] = 0;
            $labels[] = $start->formatLocalized('%b');
            $start->addMonth();
        }

        return [
            [
                'income' => $months,
                'expense' => $months
            ],
            $labels
        ];
    }

    /**
     * Merges statistics with with new transactions
     *
     * @param Collection $transactions
     * @param array $statistics
     * @param float $rate
     * @return array
     */
    protected function mergeTransactionsWith(Collection $transactions, array $statistics, $rate)
    {
        foreach ($transactions as $transaction) {
            $statistics[$transaction->type][$transaction->created_at->month] += intval($transaction->amount) / $rate;
        }

        return $statistics;
    }

    /**
     * Generates summary for the statistics
     *
     * @param array $statistics
     * @param int $accountId
     * @return array
     */
    protected function generateSummary(array $statistics, $accountId)
    {
        $totalIncome = array_sum($statistics['income']);
        $totalExpense = array_sum($statistics['expense']);
        $profit = $totalIncome - $totalExpense;

        return [
            'total_income' => currency_string_for(floor($totalIncome), $accountId),
            'total_expense' => currency_string_for(floor($totalExpense), $accountId),
            'total_profit' => currency_string_for(floor($profit), $accountId),
        ];
    }

    /**
     * Normalizes statistics while turning them into currency strings
     *
     * @param array $statistics
     * @param int $accountId
     * @return array
     */
    protected function normalizeStatistics(array $statistics, $accountId)
    {
        foreach ($statistics as $category => $months) {
            foreach ($months as $month => $value) {
                $statistics[$category][$month] = currency_float_for(floor($value), $accountId);
            }

            $statistics[$category] = array_values($statistics[$category]);
        }

        return $statistics;
    }

}