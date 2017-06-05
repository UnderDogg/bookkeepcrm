@extends('layout.content')

@php
$currentSection = 'relations';
$currentRoute = 'bookkeeper.people.index';
@endphp

@section('actions')
    @include('partials.search', ['key' => 'people'])
    @include('partials.bulk', ['key' => 'people'])


    {!! header_action_open('people.new', 'header__action--right') !!}
    {!! action_button(route('bookkeeper.people.create'), 'icon-user-create') !!}
    {!! header_action_close() !!}
@endsection