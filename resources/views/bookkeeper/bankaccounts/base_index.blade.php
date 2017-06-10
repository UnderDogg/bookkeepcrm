@extends('layout.content')

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('actions')
    @include('partials.search', ['key' => 'bankaccounts'])
    @include('partials.bulk', ['key' => 'bankaccounts'])


    {!! header_action_open('bankaccountsnew', 'header__action--right') !!}
    <a href="#" id="incomeButton" class="transaction-buttons__button transaction-buttons__button--income"></a>
    {!! header_action_close() !!}
@endsection