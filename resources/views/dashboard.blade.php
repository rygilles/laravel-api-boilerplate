<!DOCTYPE html>
<html lang="<?php echo(App::getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="img/favicon.jpg">
    <link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script src="/js/pace.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'apiDocBaseUrl' => config('app.url') . '/docs',
            'apiDocVersionUri' => 'v1',
        ]) !!};
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">

    <div id="dashboard"></div>
    <script src="{{ mix('/js/dashboard.js') }}"></script>

</body>
</html>
