@section('modules')
    @parent

    <div class="transaction-buttons">
        <a href="#" id="expenseButton" class="transaction-buttons__button transaction-buttons__button--expense"></a><a
                href="#" id="incomeButton" class="transaction-buttons__button transaction-buttons__button--income"></a>
    </div>

    @include('bankaccounts.bankmodal')
@endsection


@section('scripts')
    @parent
    <script>
        window.transactionModal = true;

    </script>
    {!! Theme::js('js/transactions.js') !!}
@endsection