@extends('layout.form')

@php
$currentSection = 'finance';
$currentRoute = 'bookkeeper.companies.index';
@endphp

@section('header_content')
    @include('partials.header', [
        'headerTitle' => $pageTitle,
        'headerHint' => link_to_route('bookkeeper.companies.index', uppercase(trans('companies.title')))
    ])
@endsection

@section('form_buttons')
    {!! submit_button('icon-list-add') !!}
@endsection

@section('content')
    @include('partials.form')
@endsection