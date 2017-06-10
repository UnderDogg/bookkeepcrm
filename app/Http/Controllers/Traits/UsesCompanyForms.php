<?php

namespace Bookkeeper\Http\Controllers\Traits;


use Illuminate\Http\Request;
use Bookkeeper\Bookkeeping\Company;

trait UsesCompanyForms
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
     * @param Company $company
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getEditForm($id, Company $company)
    {
        return $this->form('Bookkeeper\Html\Forms\Companies\CreateEditForm', [
            'method' => 'PUT',
            'url' => route('bookkeeper.companies.update', $id),
            'model' => $company
        ]);
    }

    /**
     * @param Request $request
     * @param Company $company
     */
    protected function validateEditForm(Request $request, Company $company)
    {
        $this->validateForm('Bookkeeper\Html\Forms\Companies\CreateEditForm', $request, [
            'name' => ['required', 'max:255',
                'unique:companies,name,' . $company->getKey()],
        ]);
    }

}