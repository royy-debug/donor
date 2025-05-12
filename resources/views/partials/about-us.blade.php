  <!-- About Us Section -->
  <section id="about_us" class="py-12">
    <div class="container mx-auto">
        <h2 class="section-title tracking-widest pb-4 font-Poppins">ABOUT US</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="ml pt-8">
                <p class="text-gray-600">
                    "A drop of blood, a million hopes" – together let's donate, we care and share happiness.
                </p>
                <p class="mt-4 text-gray-600">
                    Come on, donate blood, an application that makes it easy for you to donate blood, find donor
                    locations and
                    Get information about blood donation.
                </p>
                <p class="mt-4 text-gray-600">
                    Helping to save and give hope to others, as the saying goes, one drop of your blood can be a
                    source of blood for those in need.
                </p>
            </div>
            <div class="space-y-4">
                <div class="feature-item flex">
                    <div class="icon-wrapper">
                        <i class="fas fa-laptop-medical icon"></i>
                    </div>
                    <a href="{{ route('register') }}">
                        <div class="ml-4">
                            <h3 class="feature-title">Register Online</h3>
                            <p class="text-gray-600">Register for Blood Donors Online</p>
                        </div>
                </div>
                </a>

                <div class="feature-item flex">
                    <div class="icon-wrapper">
                        <i class="fas fa-tint icon"></i>
                    </div>
                    <a href="#blood_stock">
                        <div class="ml-4">
                            <h3 class="feature-title">Blood Stock</h3>
                            <p class="text-gray-600">Blood Stock Information</p>
                        </div>
                    </a>
                </div>
                <div x-data="{ open: false }"> <!-- INI ADALAH WRAPPER -->

                    <!-- Trigger buka modal -->
                    <div @click="open = true"
                        class="feature-item flex items-center cursor-pointer p-4 bg-white shadow-md rounded-lg hover:bg-red-100 transition duration-300">
                        <div class="icon-wrapper text-red-600 text-3xl">
                            <i class="fas fa-calendar-alt icon"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="feature-title text-lg font-semibold">Blood Donation Schedule</h3>
                            <p class="text-gray-600">Nearest Blood Donor Schedule</p>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                        style="display: none;">
                        <div class="bg-white rounded-lg w-11/12 md:w-1/2 p-6 relative shadow-lg">
                            <!-- Tombol Close -->
                            <button @click="open = false"
                                class="absolute top-2 right-2 text-gray-600 hover:text-red-600 text-2xl">&times;</button>

                            <h2 class="text-2xl font-bold text-red-600 mb-4">Nearest Blood Donor Schedule</h2>

                            <ul class="space-y-4 text-gray-700">
                                <li><strong>Lokasi:</strong> PMI Kota<br /> <strong>Tanggal:</strong> 20 Maret 2025
                                </li>
                                <li><strong>Lokasi:</strong> Lapangan Merdeka<br /> <strong>Tanggal:</strong> 23
                                    Maret 2025</li>
                                <li><strong>Lokasi:</strong> Kampus ABC<br /> <strong>Tanggal:</strong> 28 Maret
                                    2025</li>
                            </ul>

                            <div class="text-right mt-6">
                                <button @click="open = false"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300">Tutup</button>
                            </div>
                        </div>
                    </div>

                </div> <!-- Penutup x-data -->

            </div>
        </div>
    </div>
</section>