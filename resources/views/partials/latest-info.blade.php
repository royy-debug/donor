 <!-- INFORMASI TERKINI Section -->
 <section id="informasi_terkini" class="py-16 px-6 bg-gray-50">
    <div class="container mx-auto overflow-hidden">
        <h2 class="text-3xl font-bold text-red-600 tracking-widest mb-8 text-center font-Poppins">
            LATEST INFORMATION
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 items-center">

            <!-- Swiper di kiri (2 kolom) -->
            <div class="md:col-span-2 flex flex-col justify-center items-center relative">
                <div class="swiper-container info-swiper w-full overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('images/info1.svg') }}" alt="Info 1"
                                class="rounded-lg shadow-xl max-w-full max-h-72 object-contain transition-transform hover:scale-105">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/info2.svg') }}" alt="Info 2"
                                class="rounded-lg shadow-xl max-w-full max-h-72 object-contain transition-transform hover:scale-105">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/info3.svg') }}" alt="Info 3"
                                class="rounded-lg shadow-xl max-w-full max-h-72 object-contain transition-transform hover:scale-105">
                        </div>
                    </div>
                </div>




            </div>

            <!-- Tombol di kanan (1 kolom) -->
            <div class="flex flex-col justify-center items-center text-center">
                <p class="text-lg font-semibold text-gray-700 mb-6">
                    See more complete information here!
                </p>
                <a href="{{ route('informasi') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md text-sm shadow-md transition-transform transform hover:scale-105">
                    Read more
                </a>
            </div>

        </div>
    </div>

    <!-- Swiper Script -->
    <script>
        const swiper = new Swiper('.info-swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</section>