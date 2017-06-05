@extends('bankaccountsbase_edit')
<?php $_withForm = false; $contentsListModifier = 'content-list-container--separated'; ?>

@section('content')
    @include('bankaccountstabs', [
        'currentRoute' => 'bookkeeper.bankaccounts.transactions',
        'currentKey' => $bankaccount->getKey()
    ])

    @parent
@endsection

@include('transactions.contents', ['currentAccountId' => $bankaccount->getKey()])