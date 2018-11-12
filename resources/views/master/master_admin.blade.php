<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('pageTitle') - My Anime</title>
  <link href="{{ asset('img/logo1_oyA_icon.ico') }}" rel="icon" type="image/ico">
  <link href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/argon.css?v=1.0.0') }}" type="text/css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
</head>
<body>
  @include('sweetalert::alert')
  @include('partial.navbar_admin')
  <div class="main-content">
  @include('partial.top_admin')
      @yield('content')
  </div>
  <script src="{{ asset('admin/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <script src="{{ asset('admin/js/argon.js?v=1.0.0') }}"></script>
  @yield('script')
</body>
</html>