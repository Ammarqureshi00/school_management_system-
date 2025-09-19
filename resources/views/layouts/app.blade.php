<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title', 'Dashboard')</title>

      <!-- AdminLTE CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <!-- FontAwesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

      @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">

            <!-- Navbar -->
            @include('layouts.partials.header')

            <!-- Sidebar -->
            @include('layouts.partials.sidebar')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                  <!-- Content Header -->
                  <section class="content-header">
                        <div class="container-fluid">
                              <h1>@yield('content_header')</h1>
                        </div>
                  </section>

                  <!-- Main Content -->
                  <section class="content">
                        <div class="container-fluid">
                              @yield('content')
                        </div>
                  </section>
            </div>

            <!-- Footer -->
            @include('layouts.partials.footer')
      </div>

      <!-- Scripts -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

      @stack('scripts')
</body>

</html>