<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width"/>

    <link href='https://fonts.googleapis.com/css?family=Lato:400,700|Oxygen:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body{font:16px/20px 'Oxygen',sans-serif;color:#FFFFFF;padding:64px;}
        table{max-width:768px;width:100%;background-color:#272E36;border:1px solid #95A5A6;padding:32px;}
        h1{font:32px/32px 'Oxygen',sans-serif;margin-bottom:16px;}
        h4{color:#F1C40F;font:12px/14px 'Lato', sans-serif;margin-bottom:0;}
        a{font-size:12px;color:#F1C40F;}
    </style>
</head>
<body>
<table>
    <tr>
        <td class="center" align="center" valign="top">
            <center>

                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#F1C40F;}
                </style>
                <path class="st0" d="M44.6,4.7l-12.6,9l-12.6-9L2,0v49.5l15.8,4.2L32,64l14.3-10.2L62,49.5V0L44.6,4.7z M16.7,49.5L5.8,46.6V5
                l10.9,2.9V49.5z M30.1,58L20.5,51V10.1l9.6,6.9V58z M33.9,17l9.6-6.9V51L33.9,58V17z M58.2,46.6l-10.9,2.9V7.9L58.2,5V46.6z"/>
                </svg>

                <h4>BOOKKEEPER</h4>
                <h1>@yield('pageTitle')</h1>

                @yield('content')

            </center>
        </td>
    </tr>
</table>
</body>
</html>