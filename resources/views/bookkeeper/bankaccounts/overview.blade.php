@extends('bankaccounts.base_edit')
<?php $_withForm = false; ?>

@php
$currentSection = 'finance';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('content')
    @include('bankaccountstabs', [
        'currentRoute' => 'bookkeeper.bankaccounts.overview',
        'currentKey' => $bankaccount->getKey()
    ])

    @include('overview.chart')
@endsection

@include('transactions.create', ['currentAccountId' => $bankaccount->getKey()])