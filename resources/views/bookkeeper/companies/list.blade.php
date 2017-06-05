@foreach($companies as $bankaccount)
    <tr class="content-list__row--body">

        {!! content_list_thumbnail($bankaccount->getKey()) !!}

        <td class="content-list__cell">
            {!! link_to_route('bookkeeper.companies.overview', $bankaccount->name, $bankaccount->getKey()) !!}
        </td>
        <td class="content-list__cell">
            {{ currency_string_for($bankaccount->getBalance(), $bankaccount) }}
        </td>
        <td class="content-list__cell content-list__cell--secondary">
            {{ $bankaccount->currency }}
        </td>
        <td class="content-list__cell content-list__cell--secondary">
            {{ $bankaccount->created_at->formatLocalized('%b %e, %Y') }}
        </td>

        {!! content_options('companies', $bankaccount->getKey()) !!}

    </tr>
@endforeach