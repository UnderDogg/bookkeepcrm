@extends('layout.' . ((isset($_withForm) && $_withForm === false) ? 'content' : 'form'))

@php
$currentSection = 'bookkeeping';
$currentRoute = 'bookkeeper.companies.index';
@endphp

@section('header_content')
    @include('partials.header', [
        'headerTitle' => $company->name . ': ',
        'headerHint' => link_to_route('bookkeeper.companies.index', uppercase(trans('companies.title')))
    ])
@endsection