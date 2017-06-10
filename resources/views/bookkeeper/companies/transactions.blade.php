@extends('companies.base_edit')
<?php $_withForm = false; $contentsListModifier = 'content-list-container--separated'; ?>

@section('content')
    @include('companies.tabs', [
        'currentRoute' => 'bookkeeper.companies.transactions',
        'currentKey' => $bankaccount->getKey()
    ])

    @parent
@endsection

@include('transactions.contents', ['currentBankAccountId' => $bankaccount->getKey()])