<!DOCTYPE html>
<html lang="{{ get_full_locale_for(App::getLocale(), true) }}" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') &mdash; Bookkeeper</title>

    {!! Theme::css('css/app.css') !!}
    <link href='https://fonts.googleapis.com/css?family=Oxygen:400,700,300|Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>
<body class="@yield('bodyClass')">

@yield('body')

@yield('modal')

@yield('modules')

{!! Theme::js('js/app.js') !!}

@yield('scripts')

</body>
</html>