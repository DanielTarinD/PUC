<meta charset="utf-8" />
<title>SDUOPOT | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="/assets/css/vendor.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
<style>
    @media (max-width: 480px) {

        .plataformaWeb { display: none; }

    }

</style>
<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
