@extends('bankaccounts.base_edit')

@section('form_buttons')
    {!! submit_button('icon-floppy') !!}
@endsection

@section('content')
    @include('bankaccountstabs', [
        'currentRoute' => 'bookkeeper.bankaccounts.edit',
        'currentKey' => $bankaccount->getKey()
    ])

    @include('partials.form')
@endsection