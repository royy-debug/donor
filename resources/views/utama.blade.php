<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Blood Donor Application</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet" />
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <!-- Swiper CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body class="font-roboto">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container flex justify-between items-center py-5">
            <div class="flex items-center ">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="object-contain" />
            </div>
            <nav class="flex space-x-4 items-center">
                <a href="#home_page" class="nav-link">Homepage</a>
                <a href="#about_us" class="nav-link">About Us</a>
                <a href="#blood_stock" class="nav-link">Bloodstock</a>
                <a href="#education" class="nav-link">Education</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="nav-link text-red-500 hover:text-red-600 transition duration-300">
                        Logout
                    </button>
                </form>
            </nav>   
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home_page" class="bg-gradient-to-r from-red-100 to-white py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
            <!-- Text sebelah kiri -->
            <div class="text-left max-w-lg mb-8 md:mb-0">
                <h1 class="text-4xl font-bold text-red-600 leading-tight">
                    Blood Donor, Save Lives – Caring For Others Application
                </h1>
                <p class="mt-4 text-gray-600 text-lg">
                    A blood donor application that makes it easy for you to donate blood and help others. </p>
                <div class="mt-6">
                    <a href="{{ asset(route('donor.prescreen.form')) }}"
                        class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
                        Donate Now
                    </a>
                </div>
            </div>

            <!-- Logo sebelah kanan -->
            <div class="flex justify-center items-center ">
                <img src="{{ asset('images/donor.svg') }}" alt="Illustration of a person donating blood"
                    class="w-45 h-45" />
            </div>
        </div>
    </section>

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

    <!-- Bloodstock Section -->
    <section id="blood_stock" class="py-12 bg-gradient-to-l from-red-100 via-gray-50 to-white-100">
        <div class="container mx-auto">
            <h2 class="section-title tracking-widest pb-6 font-Poppins">BLOODSTOCK</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Left: List Data -->
                <div class="space-y-4">
                    <ul class="space-y-2 text-lg text-gray-700">
                        @foreach ($stok as $item)
                            <li class="flex items-center justify-between border-b pb-2">
                                <span class="font-medium">Blood type {{ $item->blood_type }}</span>
                                <span class="text-red-600">{{ $item->total_darah }} ML</span>
                            </li>
                        @endforeach
                    </ul>

                    @php
                        $totalDarah = $stok->sum('total_darah');
                    @endphp

                    <p class="text-xl font-semibold mt-4 pr-5">
                        Total Blood Stock: <span class="text-red-600">{{ $totalDarah }} ML</span>
                    </p>
                </div>

                <!-- Right: Donut Chart -->
                <div class="shadow-lg rounded-lg bg-white p-4 flex justify-center items-center"
                    style="width: 100%; height: 400px;">
                    <canvas id="donutChart" width="400" height="400"></canvas>
                </div>
            </div>

            <!-- Chart.js CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Donut Chart Script -->
            <script>
                const ctx = document.getElementById('donutChart').getContext('2d');

                // Plugin custom buat teks di tengah
                const centerText = {
                    id: 'centerText',
                    beforeDraw(chart, args, options) {
                        const {
                            width
                        } = chart;
                        const {
                            height
                        } = chart;
                        const {
                            ctx
                        } = chart;

                        ctx.restore();
                        const fontSize = (height / 120).toFixed(2);
                        ctx.font = `${fontSize}em sans-serif`;
                        ctx.textBaseline = 'middle';
                        ctx.fillStyle = '#ef4444'; // warna teks tengah

                        const text = '{{ $totalDarah }} ml';
                        const textX = Math.round((width - ctx.measureText(text).width) / 2);
                        const textY = height / 2;

                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                };

                const data = {
                    labels: [
                        @foreach ($stok as $item)
                            '{{ $item->blood_type }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Jumlah Stok Darah',
                        data: [
                            @foreach ($stok as $item)
                                {{ $item->total_darah }},
                            @endforeach
                        ],
                        backgroundColor: [
                            '#D81B60', // B
                            '#FF0000', // O
                            '#E53935', // A
                            '#8E24AA' // AB
                        ],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                };

                const options = {
                    responsive: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#333',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    return `${label}: ${value} ml`;
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        duration: 1000
                    }
                };

                // Register plugin centerText pas bikin chart
                const donutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: options,
                    plugins: [centerText] // <-- MASUKIN PLUGIN DI SINI BRO!
                });
            </script>
        </div>
    </section>


    {{-- <section id="blood_stock" class="py-12 bg-gradient-to-l from-red-100 via-gray-50 to-white-100">
      <div class="container mx-auto">
        <h2 class="section-title tracking-widest pb-6 font-Poppins">BLOODSTOCK</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Left: List Data -->
          <div class="space-y-4">
            <ul class="space-y-2 text-lg text-gray-700">
              @foreach ($stok as $item)
                <li class="flex items-center justify-between border-b pb-2">
                  <span class="font-medium">Golongan {{ $item->blood_type }}</span>
                  <span class="text-red-600">{{ $item->total_darah }} ML</span>
                </li>
              @endforeach
            </ul>

            @php
              $totalDarah = $stok->sum('total_darah');
            @endphp

            <p class="text-xl font-semibold mt-4 pr-5">
              Total Stok Darah: <span class="text-red-600">{{ $totalDarah }} ML</span>
            </p>
          </div>

          <!-- Right: Diagram Chart -->
          <div>
            <div id="chart_div" class="shadow-lg rounded-lg bg-white p-4" style="width: 100%; height: 400px;"></div>
          </div>
        </div>

        <!-- Chart Script -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', { packages: ['corechart'] });
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Golongan Darah', 'Jumlah Stok'],
              @foreach ($stok as $item)
                ['{{ $item->blood_type }} ({{ $item->total_darah }})', {{ $item->total_darah }}],
              @endforeach
            ]);

            var options = {
              is3D: true,
              pieSliceText: 'label',
              titleTextStyle: { fontSize: 18, bold: true, color: '#333' },
              legend: { position: 'bottom', textStyle: { fontSize: 12, color: '#555' } },
              colors: ['#ef4444', '#3b82f6', '#facc15', '#14b8a6'],
              chartArea: { width: '90%', height: '75%' },
              backgroundColor: 'transparent',
              animation: { startup: true, duration: 1000, easing: 'out' },
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }

          window.addEventListener('resize', drawChart);
        </script>
      </div>
    </section> --}}
    <!-- Education Section -->
    <!-- EDUCATION Section -->
    <section id="education" class="py-12 px-4">
        <div class="container mx-auto">
            <h2 class="section-title font-Poppins tracking-widest pb-4">EDUCATION</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="education-item">
                    <i class="fas fa-user-md icon-lg"></i>
                    <p class="text-gray-600">Ibu Menyusui Dilarang Untuk Melakukan Donor Darah</p>
                </div>
                <div class="education-item">
                    <i class="fas fa-birthday-cake icon-lg"></i>
                    <p class="text-gray-600">Umur Minimal Untuk Mengikuti Donor Darah Yaitu 16 Tahun Ke Atas</p>
                </div>
                <div class="education-item">
                    <i class="fas fa-smoking-ban icon-lg"></i>
                    <p class="text-gray-600">Orang Yang Sering Merokok Dilarang Untuk Melakukan Donor Darah</p>
                </div>
                <div class="education-item">
                    <i class="fas fa-female icon-lg"></i>
                    <p class="text-gray-600">Perempuan Yang Sedang Datang Bulan Dilarang Mengikuti Donor Darah</p>
                </div>
                <div class="education-item">
                    <i class="fas fa-weight icon-lg"></i>
                    <p class="text-gray-600">Untuk Berat Badan Laki Laki Maupun Perempuan Minimal 47 Kg</p>
                </div>
                <div class="education-item">
                    <i class="fas fa-ban icon-lg"></i>
                    <p class="text-gray-600">tidak disarankan begadang jika esok harinya mengikuti kegiatan donor darah
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI TERKINI Section -->
    <section id="informasi_terkini" class="py-12 px-4 bg-white">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-red-600 tracking-widest mb-6 text-center font-Poppins pb-5">
                LATEST INFORMATION </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <!-- Swiper di kiri (2 kolom) -->
                <div class="md:col-span-2 flex flex-col justify-center items-center relative">
                    <div class="swiper-container w-full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('images/info1.svg') }}" alt=""
                                    class="rounded-lg shadow-md max-w-full max-h-64 object-contain" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/info2.svg') }}" alt=""
                                    class="rounded-lg shadow-md max-w-full max-h-64 object-contain" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/info3.svg') }}" alt=""
                                    class="rounded-lg shadow-md max-w-full max-h-64 object-contain" />
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination"
                        style="
                    position: absolute;
                    left: 150px;
                    bottom: 10px;
                    width: auto;">
                    </div>
                </div>

                <!-- Tombol di kanan (1 kolom) -->
                <div class="flex flex-col justify-center items-center">
                    <p class="text-lg font-semibold text-gray-700 mb-4 text-center">
                        See more complete information here! </p>
                    <a href="{{ route('informasi') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md text-sm shadow-md transition-transform hover:scale-105">
                        Read more
                    </a>
                </div>
            </div>
        </div>
        <!-- Swiper Script -->
        <script>
            const swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        </script>

    </section>

    <!-- Footer -->
    <footer class="relative bg-red-600 text-white pt-16 pb-6">
        <div class="container mx-auto relative z-0">
            <div class="flex flex-wrap justify-between text-center md:text-left">
                <div class="w-full md:w-1/3 mb-6">
                    <div class="flex items-center ">
                        <img src="{{ asset('images/bottom.svg') }}" alt="Logo" class="object-contain" />
                    </div>
                    <p class="text-sm text-gray-100 pt-5">
                        An application that makes it easy for you to donate blood and help others.
                    </p>
                </div>
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-gray-300">Homepage</a></li>
                        <li><a href="#" class="hover:text-gray-300">About Us</a></li>
                        <li><a href="#" class="hover:text-gray-300">Bloodstock</a></li>
                        <li><a href="#" class="hover:text-gray-300">Education</a></li>
                    </ul>
                </div>
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <p class="text-sm text-gray-100">Email: info@blooddonor.com</p>
                    <p class="text-sm text-gray-100">Phone: +62 812 3456 7890</p>
                </div>
            </div>

            <div class="mt-8 text-center text-xs text-gray-200">
                &copy; 2025 Blood Donor. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>
