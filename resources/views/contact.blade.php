{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Hubungi Kami – Palang Merah SMKN 6 Jember')

@push('styles')
  <style>
    /* Animasi Fade In */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 1s ease-out, transform 1s ease-out;
    }
    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
@endpush

@section('content')
  <!-- Header Image -->
  <section class="relative w-full overflow-hidden pt-8 sm:pt-10">
    <div class="max-w-6xl mx-auto px-4">
      <img
        src="{{ asset('images/foto.svg') }}"
        alt="Palang Merah SMKN 6 Jember"
        loading="lazy"
        class="rounded-3xl shadow-lg object-cover w-full max-h-[400px] sm:max-h-[500px] fade-in"
      />
    </div>
  </section>

  <!-- Contact Info -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="text-center mb-12 fade-in">
        <h2 class="text-4xl font-bold text-red-600">Hubungi Kami</h2>
        <p class="text-gray-600 text-xs sm:text-sm mt-2">Kami siap melayani Anda melalui kontak di bawah ini</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 text-center fade-in">
        <!-- Telepon -->
        <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
          <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
            <i class="fas fa-phone-alt text-red-500 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold mb-1">Call Us</h3>
          <a href="https://wa.me/6287861589235" target="_blank" class="text-gray-600 hover:text-red-500 transition">
            +62 878-6158-9235
          </a>
        </div>

        <!-- Instagram -->
        <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
          <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
            <i class="fab fa-instagram text-red-500 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold mb-1">Instagram</h3>
          <p class="text-gray-600 text-xs sm:text-sm">Visit Our Instagram</p>
          <a href="https://www.instagram.com/_praskanamber" target="_blank" rel="noopener noreferrer"
             class="text-red-500 font-semibold hover:underline">
            PMR_WIRA
          </a>
        </div>

        <!-- Lokasi -->
        <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
          <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
            <i class="fas fa-map-marker-alt text-red-500 text-2xl"></i>
          </div>
          <h3 class="text-lg font-semibold mb-1">Lokasi Kami</h3>
          <a href="https://maps.app.goo.gl/jDT7QWAa4BgppRgV8" target="_blank" rel="noopener noreferrer"
             class="text-gray-600 text-xs sm:text-sm hover:text-red-600 transition">
            Jl. PB. Sudirman, Tekoan, Tanggul Kulon, Kec. Tanggul, Kab. Jember, Jawa Timur 68155
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    // Animasi Fade In saat scroll
    const faders = document.querySelectorAll('.fade-in');
    const appearOptions = { threshold: 0.1, rootMargin: "0px 0px -50px 0px" };
    const appearOnScroll = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          obs.unobserve(entry.target);
        }
      });
    }, appearOptions);
    faders.forEach(el => appearOnScroll.observe(el));
  </script>
@endpush
