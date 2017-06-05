@extends('layout.content')

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('actions')
    @include('partials.search', ['key' => 'bankaccounts'])
    @include('partials.bulk', ['key' => 'bankaccounts'])


    {!! header_action_open('bankaccountsnew', 'header__action--right') !!}
    {!! action_button(route('bookkeeper.bankaccounts.create'), 'icon-list-add') !!}
    {!! header_action_close() !!}
@endsection