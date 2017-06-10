@extends('bankaccounts.base_edit')
<?php $_withForm = false; $contentsListModifier = 'content-list-container--separated'; ?>

@section('content')
    @include('bankaccounts.tabs', [
        'currentRoute' => 'bookkeeper.bankaccounts.transactions',
        'currentKey' => $bankaccount->getKey()
    ])

    @parent
@endsection

@include('transactions.contents', ['currentAccountId' => $bankaccount->getKey()])