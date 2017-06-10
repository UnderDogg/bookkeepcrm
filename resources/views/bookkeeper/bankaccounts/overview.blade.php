@extends('bankaccounts.base_edit')
<?php $_withForm = false; ?>

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('content')
    @include('bankaccountstabs', [
        'currentRoute' => 'bookkeeper.bankaccounts.overview',
        'currentKey' => $bankaccount->getKey()
    ])

    @include('overview.chart')
@endsection

@include('transactions.create', ['currentBankAccountId' => $bankaccount->getKey()])