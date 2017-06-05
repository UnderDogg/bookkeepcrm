@section('modules')
    @parent

    <div class="users-buttons">
        <a href="#" id="userButton" class="user-buttons__button user-buttons__button--add"></a>
    </div>

    @include('users.modal')
@endsection


@foreach($users as $user)
    <tr class="content-list__row--body">

        {!! content_list_thumbnail($user->getKey(), '<span class="navigation-user__avatar">' . $user->presentAvatar() . '</span>') !!}

        <td class="content-list__cell">
            {!! link_to_route('bookkeeper.users.edit', $user->presentFullName(), $user->getKey()) !!}
        </td>
        <td class="content-list__cell content-list__cell--secondary">
            <a href="mailto:{{ $user->email }}">
                {{ $user->email }}
            </a>
        </td>
        <td class="content-list__cell content-list__cell--secondary">
            {{ $user->created_at->formatLocalized('%b %e, %Y') }}
        </td>

        {!! content_options('users', $user->getKey()) !!}

    </tr>
@endforeach