<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Hospital')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">
  <style>
    .navbar-custom { background-color: #0f1f2d !important; }
    .navbar-custom .nav-link { color: #ffffffcc; }
    .navbar-custom .nav-link.active,
    .navbar-custom .nav-link:hover { color: #17e9b3 !important; }
  </style>
  @stack('styles')
</head>
<body>

  <!-- Dark Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">Hospital</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about.page') }}">About</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('doctors') ? 'active' : '' }}" href="{{ route('doctors.all') }}">Doctors</a></li>
          <li class="nav-item"><a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contacts.index') }}">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>@yield('content')</main>

  @include('front.layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
