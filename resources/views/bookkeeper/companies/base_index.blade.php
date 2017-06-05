@extends('layout.content')

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.companies.index';
@endphp

@section('actions')
    @include('partials.search', ['key' => 'companies'])
    @include('partials.bulk', ['key' => 'companies'])


    {!! header_action_open('companies.new', 'header__action--right') !!}
    {!! action_button(route('bookkeeper.companies.create'), 'icon-list-add') !!}
    {!! header_action_close() !!}
@endsection