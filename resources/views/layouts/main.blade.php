<!DOCTYPE html>
<html lang="en">

<head>
  <title>Zalfeet - Shoes Store</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Webestica.com">
  <meta name="description" content="Technology and Corporate Bootstrap Theme">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&amp;family=Inter:wght@400;500;600&amp;display=swap"
    rel="stylesheet">

  <!-- Plugins CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/glightbox/css/glightbox.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}">

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">

  @vite(['resources/js/app.js'])
</head>

<body>
  @include('partials.navbar')
  @yield('main')
  @include('partials.footer')

  <!-- Back to top -->
  <div class="back-top"></div>

  <!-- Bootstrap JS -->
  <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

  <!--Vendors-->
  <script src="{{ asset('vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/jarallax/jarallax.min.js') }}"></script>
  <script src="{{ asset('vendor/jarallax/jarallax-video.min.js') }}"></script>
  <script src="{{ asset('vendor/sticky-js/sticky.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.js') }}"></script>

  <!--Cdn-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Theme Functions -->
  <script src="{{ asset('js/functions.js') }}"></script>

  @stack('scripts')

</body>

</html>
