@extends('tags.base_edit')
<?php $_withForm = false; ?>

@section('content')
    @include('tags.tabs', [
        'currentRoute' => 'bookkeeper.tags.transactions',
        'currentKey' => $tag->getKey()
    ])

    OVERVIEW AND TRANSACTIONS
@endsection