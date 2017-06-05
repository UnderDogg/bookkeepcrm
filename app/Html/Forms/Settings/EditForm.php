<?php


namespace Bookkeeper\Html\Forms\Settings;


use Bookkeeper\Finance\Company;
use Bookkeeper\Support\Currencies\CurrencyHelper;
use Bookkeeper\Support\Install\InstallHelper;
use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{

    public function buildForm()
    {
        $this->add('APP_LOCALE', 'select', [
            'rules' => 'required|in:' . implode(',', array_keys(InstallHelper::$locales)),
            'choices' => InstallHelper::$locales,
            'label' => trans('validation.attributes.locale')
        ]);

        $this->add('DEFAULT_CURRENCY', 'select', [
            'rules' => 'required|in:' . implode(',', array_keys(CurrencyHelper::getCurrencies())),
            'choices' => CurrencyHelper::getCurrencies(),
            'label' => trans('currencies.default_currency')
        ]);

        $this->add('DEFAULT_BANKACCOUNT', 'select', [
            'choices' => get_bankaccounts_list(),
            'label' => trans('currencies.default_bankaccount')
        ]);


        $this->add('DEFAULT_COMPANY', 'select', [
            'choices' => get_companies_list(),
            'label' => trans('currencies.default_company')
        ]);
    }

}