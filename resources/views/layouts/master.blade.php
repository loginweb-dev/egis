<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <title>{{ $page->name }}</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="{{ asset('vendor/mdb/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/mdb/css/mdb.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('vendor/mdb/css/addons-pro/timeline.min.css') }}">

  <style>
    html,
    body,
    header,
    .view.jarallax {
      height: 100%;
      min-height: 100%;
    }
  </style>

  @laravelPWA
  @yield('css')
</head>

<body class="event-lp">
    @yield('header')

    <!-- Main content -->
    <main>
        @yield('content')
    </main>
    <!-- Main content -->

    @yield('footer')

    <script type="text/javascript" src="{{ asset('vendor/mdb/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/mdb/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/mdb/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/mdb/js/mdb.min.js') }}"></script>
    @yield('js')
    <!-- Custom scripts -->
    <script>
        // Animation init
        new WOW().init();
    </script>

</body>

</html>
