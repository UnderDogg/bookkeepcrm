@extends('companies.base_edit')
<?php $_withForm = false; ?>

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.companies.index';
@endphp

@section('content')
    @include('companies.tabs', [
        'currentRoute' => 'bookkeeper.companies.overview',
        'currentKey' => $company->getKey()
    ])
@endsection

{{--
@include('transactions.create', ['currentBankAccountId' => $bankaccount->getKey()])--}}
