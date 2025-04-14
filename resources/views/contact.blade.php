<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Palang Merah SMKN 6 Jember</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <style>
      /* Animasi Fade In */
      .fade-in {
        animation: fadeIn 1.2s ease-in-out;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Header Image -->
    <section class="relative w-full overflow-hidden">
      <div class="max-w-6xl mx-auto px-4 pt-6 fade-in">
        <img
          src="{{ asset('images/foto.svg') }}"
          alt="Palang Merah SMKN 6 Jember"
          class="rounded-3xl shadow-lg object-cover w-full max-h-[500px] sm:max-h-[400px]"
        />
      </div>
    </section>

    <!-- Contact Info -->
    <section class="py-16 bg-white">
      <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12 fade-in">
          <h2 class="text-4xl font-bold text-red-600">Hubungi Kami</h2>
          <p class="text-gray-500 mt-2 text-sm">
            Kami siap melayani Anda melalui kontak di bawah ini
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 text-center fade-in">
          <!-- Telepon -->
          <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
              <i class="fas fa-phone-alt text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Call Us</h3>
            <p class="text-gray-600">+62896452728789</p>
            <p class="text-gray-600">+62896452728789</p>
          </div>

          <!-- Instagram -->
          <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
              <i class="fab fa-instagram text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Instagram</h3>
            <p class="text-gray-600">Visit Our Instagram</p>
            <p class="text-red-500 font-semibold">@PMR_WIRA</p>
          </div>

          <!-- Lokasi -->
          <div class="flex flex-col items-center bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300">
            <div class="bg-red-100 rounded-full w-16 h-16 flex items-center justify-center mb-4">
              <i class="fas fa-map-marker-alt text-red-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold mb-1">Lokasi Kami</h3>
            <p class="text-gray-600 text-sm">
              Jl. PB. Sudirman, Tekoan, Tanggul Kulon, Kec. Tanggul, Kabupaten Jember, Jawa Timur 68155
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-red-600 p-4 text-white text-center">
      &copy; {{ date('Y') }} Aplikasi Donor Darah
    </footer>
  </body>
</html>
