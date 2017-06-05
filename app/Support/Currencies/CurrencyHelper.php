<?php


namespace Bookkeeper\Support\Currencies;

use Bookkeeper\Finance\BankAccount;
use Bookkeeper\Finance\Company;
use Cache;

class CurrencyHelper
{

    /** @var string */
    public $base = null;

    /** @var array */
    public static $currencies = [
        'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CNY', 'CZK', 'DKK',
        'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'IDR', 'ILS', 'INR',
        'JPY', 'KRW', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN',
        'RON', 'RUB', 'SEK', 'SGD', 'THB', 'TRY', 'USD', 'ZAR'
    ];

    /** @var array */
    public static $zeroDecimalCurrencies = ['JPY'];

    /** @var array */
    public static $singleDecimalCurrencies = ['CNY'];

    /** @var Company */
    protected $companies = [];

    /** @var BankAccount */
    protected $bankaccounts = [];


    /**
     * Returns a list of currencies
     *
     * @return array
     */
    public static function getCurrencies()
    {
        $currencies = [];

        foreach (static::$currencies as $currency) {
            $currencies[$currency] = $currency;
        }

        return $currencies;
    }

    /**
     * Returns the decimal digits for the currency
     *
     * @param string $currency
     * @return int
     */
    public static function getDecimalDigitsFor($currency)
    {
        if (in_array($currency, static::$zeroDecimalCurrencies)) {
            return 0;
        } elseif (in_array($currency, static::$singleDecimalCurrencies)) {
            return 1;
        }

        return 2;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->base = env('DEFAULT_CURRENCY');
    }

    /**
     * Returns the exchange rate for company
     *
     * @param int $companyId
     * @return float
     */
    public function getRateFor($companyId, $bankaccountId)
    {
        if (is_null($companyId)) {
            $companyId = get_default_company();
        }

        //dd($companyId);
        if (is_null($bankaccountId) || $bankaccountId == "") {
            $bankaccountId = get_default_bankaccount();
        }

        $company = $this->getCompany($companyId);
        $bankaccount = $this->getBankaccount($bankaccountId);

        $rates = $this->getAllRates();

        // If the currency does not exist, it should be the base
        return isset($rates[$bankaccount->currency]) ? $rates[$bankaccount->currency] : 1;
    }

    /**
     * Gets all exchange rates for the base and caches them for a day
     *
     * @return array
     */
    protected function getAllRates()
    {
        if (!Cache::has('bookkeeper.currency.rates')) {
            $defaultCompany = $this->getCompany(get_default_company());

            //$defaultaccount = get_default_bankaccount();
            $defaultBankAccount = $this->getBankAccount(get_default_bankaccount());

            $json = file_get_contents('http://api.fixer.io/latest?base=' . $defaultBankAccount->currency);

            Cache::put('bookkeeper.currency.rates', json_decode($json, true)['rates'], 1440);
        }

        return Cache::get('bookkeeper.currency.rates');
    }

    /**
     * Converts amount to currency text
     *
     * @param int $amount
     * @param int|Company $company
     * @return string
     */
    public function currencyStringFor($amount, $bankaccount)
    {
        /*if (!$company instanceof Company) {
            $company = $this->getBankAccount($company);
        }*/

        if (!$bankaccount instanceof BankAccount) {
            $bankaccount = $this->getBankAccount($bankaccount);
        }


        $currency = $bankaccount->currency;
        $decimal = static::getDecimalDigitsFor($currency);

        if ($amount == 0) {
            return $this->zeroCurrencyFloat($decimal) . ' ' . $currency;
        }

        if ($decimal == 0) {
            return $amount . ' ' . $currency;
        }

        return $this->decimalCurrencyFloat($decimal, $amount) . ' ' . $currency;
    }

    /**
     * Converts amount to currency float
     *
     * @param int $amount
     * @param int $companyId
     * @return float
     */
    public function currencyFloatFor($amount, $bankaccountId)
    {
        $bankaccount = $this->getBankAccount($bankaccountId);

        $decimal = static::getDecimalDigitsFor($bankaccount->currency);

        if ($amount == 0) {
            return $this->zeroCurrencyFloat($decimal);
        }

        if ($decimal == 0) {
            return $amount;
        }

        return $this->decimalCurrencyFloat($decimal, $amount);
    }

    /**
     * Gets and caches an company
     *
     * @param int $id
     * @return Company
     */
    protected function getBankAccount($id)
    {

        if (is_null($id) || $id == "") {
            $id = 1;
        }


        if (!array_key_exists($id, $this->bankaccounts)) {
            $bankaccount = BankAccount::findOrFail($id);
            $this->bankaccounts[$id] = $bankaccount;
        }

        return $this->companies[$id];
    }


    /**
     * Gets and caches an company
     *
     * @param int $id
     * @return Company
     */
    protected function getCompany($id)
    {
        if (!array_key_exists($id, $this->companies)) {
            $company = Company::findOrFail($id);
            $this->companies[$id] = $company;
        }

        return $this->companies[$id];
    }

    /**
     * Generates a zero string response
     *
     * @param int $decimal
     * @return string
     */
    protected function zeroCurrencyFloat($decimal)
    {
        if ($decimal == 0) {
            return 0;
        } elseif ($decimal == 1) {
            return 0.0;
        }

        return 0.00;
    }

    /**
     * Generates a decimal based amount response
     *
     * @param int $decimal
     * @param int $amount
     * @return float
     */
    protected function decimalCurrencyFloat($decimal, $amount)
    {
        if ($decimal == 1) {
            return $amount / 10;
        }

        return $amount / 100;
    }

}