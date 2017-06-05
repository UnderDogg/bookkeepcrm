<?php

namespace Bookkeeper\Html\Forms\Transactions;


use Kris\LaravelFormBuilder\Form;

class EditForm extends Form
{

    /**
     * Form options
     *
     * @var array
     */
    protected $formOptions = [
        'method' => 'PUT'
    ];

    public function buildForm()
    {
        $this->add('name', 'text', [
            'rules' => 'required|max:255',
        ]);
        $this->add('amount', 'amount', [
            'rules' => 'required|integer',
        ]);


        $this->add('company_id', 'select', [
            'rules' => 'required',
            'label' => trans('companies.self'),
            'choices' => get_companies_list()
        ]);

        $this->add('bankaccount_id', 'select', [
            'rules' => 'required',
            'label' => trans('bankaccounts.self'),
            'choices' => get_bankaccounts_list()
        ]);


        $this->add('created_at', 'datetime', [
            'rules' => 'required'
        ]);
        $this->add('received', 'checkbox');
        $this->add('notes', 'textarea');
    }

}