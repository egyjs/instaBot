<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" sizes="192x192" href="//www.instagram.com/static/images/ico/favicon-192.png/68d99ba29cc8.png">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ispinner.css') }}" rel="stylesheet">
    <style>
        :root {
            --input-padding-x: .75rem;
            --input-padding-y: .75rem;
        }
        body{
            background-color: #ffffff;
        }

        .InstaLogo {
            background-size: 410px 396px;
            background-position: 0 -97px;
            background-repeat: no-repeat;
            background-position: -98px 0;
            height: 51px;
            width: 175px;
            margin: 27px auto;
        }

        .form-control{
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 3px;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            color: #262626;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            font-size: 14px;
            position: relative;
            -webkit-appearance: none;
            width: 100%;
            border: 1px solid #efefef;
            background: #fafafa;
        }
        .form-control:focus {
            color: #495057;
            background-color: #fafafa !important;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(52,144,220,.25) !important;
        }
        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group > input,
        .form-label-group > label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            color: #999;
            font-size: 12px !important;
            height: 37px;
            left: 0px;
            line-height: 1;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
            right: 0;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }


        .btn-primary , .btn-primary:visited {
            background-color: #3897f0;
            border: 1px solid #3897f0;
            border-radius: 4px;
            color: #fff;
            position: relative;
            font: inherit;
            font-weight: bold;
        }
        ._8Bp8U {
            color: #3897f0;
            font-size: 12px;
            line-height: 14px;
            margin-top: 22px;
            text-align: center;
        }
        .loading {
            height: 18px;
            margin-left: -9px;
            margin-top: -9px;
            width: 18px;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoyRTNGMkVENTlEMjE2ODExODIyQUNEMjMwNzUzNTEzMyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowMzIxMkU3QTcxMUUxMUUyQjdFMUNDNDg3OTE3RUY5RCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowMzIxMkU3OTcxMUUxMUUyQjdFMUNDNDg3OTE3RUY5RCIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ1M2IChNYWNpbnRvc2gpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6ODJGQzEwNTI1MDIyNjgxMTgyMkFDRDIzMDc1MzUxMzMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MkUzRjJFRDU5RDIxNjgxMTgyMkFDRDIzMDc1MzUxMzMiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6COBsvAAACo0lEQVR42uyZu08UURjFZ1Y2GjQ+MIaEmODb1qVGQkMhhZ001rKN8Q+AWFjY2NqwGgsrKwq1oqAxgYagogWNxS6ymvAw+AAW3TCem5xNbibcuzM7995x4nzJL8zOzM6cc1/fd1k/CAIvy1HwMh65gdxAbiDj0WXjoeVyWXmtUqlkpgdGwCdQBTezOISmwEXQLxre1kv8qJlYNywUEX6wH+fLUYfaf7kKnQdPwAswbEDDYXAGnAZFFwYmwAC4DB6BGwnEHwE9FC6MnHRh4Fjo+w86NCHEnwrNjYILA49BM6GJg8SL+OHCwDyYVJgYlc6tSsffIojfAruu8sCswsR9cJaf74INih/nuUMa8TuuS4lZ/n0oPafIVUq0/ksSfp8x8SbyQKsn9vh5BSxq7v8t9VqQVHzbTBwj+/aBC+BtS1A4k0rP8rlkNkNDsKPMbKoa/UKilhgNl+V0STQgOK64LobBU/BOV7/I19gbJ8A5jYY/oAa+J50DdzTiPWbP8Q4ar79NAxZ5j5NirunZicCEgSmu56rY4BCKG1WuSroVq2ZiDnwA9+LuGTSrkFw2fLQ6iQ+YeLp50MsWa0R4pyidf4HtpBsaE8voVXCLz9rikGto3jcEjoJ98B7U0/yvhBA/xhqn1ROilFhW9FgPxbfmX4nH9TQMhMV7bNV1HouibpBC5zi8fvKegpSVE5koGBQvlrzX0oo1yPwhNkDXeW6X5cZ+aLNfkqpY6wYuKcS/EtlYOicnv27p+KvCxDXWVNYNDEcQ3y5UJq64MLCXULzORNOFgRnwmZN1ukPxsokFFmybYMnFKrQGnhmsd9ZIKjuy1MO38Sslk9htKWmJefM8TonwL/TAHEsKIf6NrZd0WTRQJVYjnwNpR/4rZW4gN5Dx+CvAABjBsk/oCqxuAAAAAElFTkSuQmCC);
            -webkit-animation: spinner-spin8 .8s steps(8) infinite;
            animation: spinner-spin8 .8s steps(8) infinite;
        }

    </style>
</head>
<body>
    <div id="app">
        <main class=" py-4">
            @yield('content')
        </main>
    </div>


    <!-- script -->
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
@stack('js')
</body>
</html>
