@extends('bankaccounts.base_index')

@section('header_content')
    @include('partials.header', [
        'headerTitle' => $pageTitle
    ])
@endsection

@section('content_sortable_links')
    <th class="content-list__cell content-list__cell--head">
        {!! sortable_link('name', uppercase(trans('validation.attributes.name'))) !!}
    </th>
    <th class="content-list__cell content-list__cell--head">
        {{ uppercase(trans('bankaccounts.balance')) }}
    </th>
    <th class="content-list__cell content-list__cell--head content-list__cell--secondary">
        {!! sortable_link('currency', uppercase(trans('validation.attributes.currency'))) !!}
    </th>
    <th class="content-list__cell content-list__cell--head content-list__cell--secondary">
        {!! sortable_link('created_at', uppercase(trans('validation.attributes.created_at'))) !!}
    </th>
@endsection

@section('content_list')
    @if($companies->count())
        @include('bankaccounts.list')
    @else
        {!! no_results_row('bankaccounts.no_accounts') !!}
    @endif
@endsection

@section('content_footer')
    @include('partials.pagination', ['paginator' => $companies])
@endsection