{{-- resources/views/partials/hero.blade.php --}}
<section id="home_page"
         x-data="{ open: false }"
         class="bg-white pt-40 pb-16 relative overflow-hidden">
  {{-- dekorasi & gambar --}}
  <div class="absolute -left-40 -top-40 w-[1100px] h-[1100px] bg-red-600 rounded-full"></div>
  <div class="absolute inset-0 z-0">
    <img src="{{ asset('images/gedung.jpg') }}" class="w-full h-full object-cover opacity-60" />
  </div>

  {{-- Konten Hero --}}
  <div class="container mx-auto relative z-10 px-6">
    <div id="heroText"
         class="max-w-2xl bg-white backdrop-blur-sm p-8 rounded-lg shadow-lg opacity-0 -translate-x-12 transition-all duration-700 ease-out">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
        <span class="text-red-600">Blood Donor</span> Save Lives – Caring for Others
      </h1>
      <p class="mt-4 text-gray-600 text-lg">
        This application makes it easy for you to become a blood donor…
      </p>
      <div class="flex gap-4 mt-6">
        <a href="{{ route('donate') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-lg">
          Donor
        </a>
        <button @click="open = true" class="border border-red-600 text-red-600 px-6 py-3 rounded-lg">
          Jadwal Donor
        </button>
      </div>
    </div>
  </div>

  {{-- Modal --}}
  <div x-show="open" x-transition
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
            <div class="bg-white rounded-lg w-11/12 md:w-1/2 p-6 relative shadow-lg">
                <button @click="open = false"
                    class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-2xl">&times;</button>
                <h2 class="text-2xl font-bold text-red-600 mb-4">Jadwal Donor Darah Terdekat</h2>
                <ul class="space-y-4 text-gray-700">
                    <li><strong>Lokasi:</strong> PMI Kota<br><strong>Tanggal:</strong> 20 Maret 2025</li>
                    <li><strong>Lokasi:</strong> Lapangan Merdeka<br><strong>Tanggal:</strong> 23 Maret 2025</li>
                    <li><strong>Lokasi:</strong> Kampus ABC<br><strong>Tanggal:</strong> 28 Maret 2025</li>
                </ul>
                <div class="text-right mt-6">
                    <button @click="open = false"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const hero = document.getElementById("heroText");
      if (!hero) return;
      setTimeout(() => {
        hero.classList.remove("opacity-0", "-translate-x-12");
        hero.classList.add("opacity-100", "translate-x-0");
      }, 300);
    });
  </script>
</section>
