@extends('layout.' . ((isset($_withForm) && $_withForm === false) ? 'content' : 'form'))

@php
$currentSection = 'finance';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('header_content')
    @include('partials.header', [
        'headerTitle' => $bankaccount->name . ': ' . currency_string_for($bankaccount->getBalance(), $bankaccount),
        'headerHint' => link_to_route('bookkeeper.bankaccounts.index', uppercase(trans('bankaccounts.title')))
    ])
@endsection