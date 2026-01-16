<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hospital')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('user/assets/css/style.css') }}" rel="stylesheet">

    @yield('styles')


    <style>
        .hero-section {
            background: url('https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        }

        /* Footer Styles (from your footer) */
        .footer a {
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer a:hover {
            color: #1a8fd2;
            padding-left: 3px;
        }
        .social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1a8fd2;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .social-icon:hover {
            background: #0f6fa3;
            transform: scale(1.1);
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    @include('front.layouts.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('front.layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')



    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68cc4ce8780fd619258a9830/1j5f0orpv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
@yield('scripts')


</body>
</html>
