@extends('companies.base_edit')
<?php $_withForm = false; ?>

@php
$currentSection = 'finance';
$currentRoute = 'bookkeeper.companies.index';
@endphp

@section('content')
    @include('companies.tabs', [
        'currentRoute' => 'bookkeeper.companies.overview',
        'currentKey' => $bankaccount->getKey()
    ])

    @include('overview.chart')
@endsection

@include('transactions.create', ['currentAccountId' => $bankaccount->getKey()])