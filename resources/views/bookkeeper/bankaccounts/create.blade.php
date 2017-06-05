@extends('layout.form')

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.bankaccounts.index';
@endphp

@section('header_content')
    @include('partials.header', [
        'headerTitle' => $pageTitle,
        'headerHint' => link_to_route('bookkeeper.bankaccounts.index', uppercase(trans('bankaccounts.title')))
    ])
@endsection

@section('form_buttons')
    {!! submit_button('icon-list-add') !!}
@endsection

@section('content')
    @include('partials.form')
@endsection