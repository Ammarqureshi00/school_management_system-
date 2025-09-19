<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <title>@yield('title', 'Auth Page')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- AdminLTE CSS -->
      <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
      <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
</head>

<body class="hold-transition login-page">

      @yield('content')

      <!-- AdminLTE JS -->
      <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>