


@section('modules')
    @parent
        {{--<a href="#" id="incomeButton" class="transaction-buttons__button transaction-buttons__button--income"></a>--}}
    @include('bankaccounts.bankmodal')
@endsection


@section('scripts')
    @parent
    <script>
        window.transactionModal = true;

    </script>
    {!! Theme::js('js/transactions.js') !!}
@endsection