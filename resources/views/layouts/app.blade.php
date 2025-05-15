<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Blood Donor Application')</title>
    
<!-- CSS & Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Scripts yang diperlukan di head -->
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    @stack('styles')
</head>
<body class="font-roboto overflow-x-hidden">

    @include('partials.preloader')
    @include('partials.header')

    <main class="pt-16">
      @yield('content')
    </main>

    @include('partials.footer')

    <!-- Global scripts -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // preloader fadeout
        setTimeout(() => {
          const pre = document.getElementById('preloader');
          if (pre) pre.classList.add('hidden');
        }, 500);
      });
    </script>
    @stack('scripts')
</body>
</html>
