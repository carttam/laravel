<!doctype html>
<html lang="fa" @yield('sp_site')>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link type="text/css" href="css/compo/bootstrap-reboot.rtl.min.css">
    <link rel="stylesheet" href="css/compo/bootstrap-icons.css">
    <link rel="stylesheet" href="css/compo/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="css/common.css">
    @yield('include_css')
</head>
<body id="body">

@yield('body')

<script src="js/compo/jquery-3.6.0.min.js"></script>
<script src="js/compo/bootstrap.bundle.min.js"></script>
<script src="js/common.js"></script>
@yield('include_js')
</body>
</html>
