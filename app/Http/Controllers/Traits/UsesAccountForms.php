<?php

namespace Bookkeeper\Http\Controllers\Traits;


use Illuminate\Http\Request;
use Bookkeeper\Finance\Company;

trait UsesAccountForms
{

    /**
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getCreateForm()
    {
        return $this->form('Bookkeeper\Html\Forms\Companies\CreateEditForm', [
            'method' => 'POST',
            'url' => route('bookkeeper.companies.store')
        ]);
    }

    /**
     * @param Request $request
     */
    protected function validateCreateForm(Request $request)
    {
        $this->validateForm('Bookkeeper\Html\Forms\Companies\CreateEditForm', $request);
    }

    /**
     * @param int $id
     * @param Company $bankaccount
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getEditForm($id, Company $bankaccount)
    {
        return $this->form('Bookkeeper\Html\Forms\Companies\CreateEditForm', [
            'method' => 'PUT',
            'url' => route('bookkeeper.companies.update', $id),
            'model' => $bankaccount
        ]);
    }

    /**
     * @param Request $request
     * @param Company $bankaccount
     */
    protected function validateEditForm(Request $request, Company $bankaccount)
    {
        $this->validateForm('Bookkeeper\Html\Forms\Companies\CreateEditForm', $request, [
            'name' => ['required', 'max:255',
                'unique:companies,name,' . $bankaccount->getKey()],
        ]);
    }

}