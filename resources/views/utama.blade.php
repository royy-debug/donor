<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Donor Application</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.style.opacity = '0';
                preloader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => preloader.style.display = 'none', 500);
            }
        }, 500); // delay 1.5 detik
    });
</script>

<body class="font-roboto overflow-x-hidden">
    <!-- Preloader -->
    <div id="preloader" class="fixed inset-0 bg-white z-50 flex flex-col items-center justify-start pt-32 sm:pt-40">
        <!-- Tetesan Darah + Gambar -->
        <div class="relative flex flex-col items-center">
            <div class="drop animate-drop mb-4 w-5 h-5 bg-red-600 rounded-full"></div>
            <img src="{{ asset('images/loader-darah.png') }}" alt="Loading"
                class="w-20 h-20 object-contain sm:w-24 sm:h-24" />
        </div>
        <p class="text-red-600 font-semibold text-base sm:text-lg mt-4 animate-pulse">Tunggu ya...</p>
    </div>

    <!-- HEADER -->
    <!-- Tambahkan Alpine.js di <head> -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <header class="fixed top-0 left-0 w-full z-30 bg-white/70 shadow-md" x-data="{ open: false }">
        <div class="container mx-auto flex justify-between items-center py-5 px-4">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="object-contain h-10" />
            </div>

            <!-- Burger button (mobile) -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    <!-- Hamburger icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-4 items-center font-semibold">
                <a href="#home_page"
                    class="nav-link text-gray-700 hover:text-red-600 transition duration-300">Homepage</a>
                <a href="#blood_stock"
                    class="nav-link text-gray-700 hover:text-red-600 transition duration-300">Stock</a>
                <a href="#education"
                    class="nav-link text-gray-700 hover:text-red-600 transition duration-300">Education</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-gray-700 hover:text-red-600 transition duration-300">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Mobile Nav Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden" @click.away="open = false"
            @keydown.escape.window="open = false">
            <!-- Drawer -->
            <div x-show="open" x-transition:enter="transition-transform ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition-transform ease-in duration-200"
                x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
                class="fixed right-0 top-0 h-full w-64 bg-white shadow-xl p-6 z-50 space-y-4 font-semibold">
                <!-- Close Button -->
                <button @click="open = false"
                    class="absolute top-4 right-4 text-gray-600 hover:text-red-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>


                <!-- Mobile Nav Links with Icons -->
                <a href="#home_page" @click="open = false"
                    class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition duration-300">

                    <!-- Home Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12l2-2m0 0l7-7 7 7m-9 9v-6h4v6" />
                    </svg>
                    Homepage
                </a>

                <a href="#blood_stock" @click="open = false"
                    class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition duration-300">
                    <!-- Drop Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2C12 2 7 8 7 12a5 5 0 0010 0c0-4-5-10-5-10z" />
                    </svg>
                    Stock
                </a>

                <a href="#education" @click="open = false"
                    class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition duration-300">
                    <!-- Book Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 016.5 17H20" />
                        <path d="M4 4.5A2.5 2.5 0 016.5 7H20v14H6.5a2.5 2.5 0 01-2.5-2.5z" />
                    </svg>
                    Education
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition duration-300 w-full text-left">
                        <!-- Logout Icon -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            <path d="M3 21h4a2 2 0 002-2V5a2 2 0 00-2-2H3" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </header>


    <!-- HERO SECTION -->
    <section id="home_page" class="bg-white pt-40 pb-16 relative overflow-hidden" x-data="{ open: false }">
        <!-- Background Dekorasi -->
        <div class="absolute -left-40 -top-40 w-[1100px] h-[1100px] bg-red-600 rounded-full z-0"></div>

        <!-- Background Foto Gedung -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/gedung.jpg') }}" alt="Foto Gedung"
                class="w-full h-full object-cover opacity-60">
        </div>

        <!-- Konten Hero -->
        <div class="container mx-auto relative z-8 px-6">
            <div id="heroText"
                class="max-w-2xl bg-white backdrop-blur-sm p-8 rounded-lg shadow-lg opacity-0 translate-x-[-50px] transition-all duration-700 ease-out">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                    <span class="text-red-600">"Blood Donor </span>Save Lives – Caring for Others Application"
                </h1>
                <p class="mt-4 text-gray-600 text-lg">
                    This application makes it easy for you to become a blood donor, find the nearest donor location, and
                    get the latest information about blood donation. By participating, you are helping to save lives and
                    strengthen solidarity among others.
                </p>
                <div class="flex gap-4 mt-6">
                    <a href="{{ route('donate') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 z-20 relative">
                        Donor
                    </a>
                    <button @click="open = true"
                        class="border border-red-600 text-red-600 px-6 py-3 rounded-lg hover:bg-red-50 transition-all duration-300 z-20 relative">
                        Jadwal Donor
                    </button>
                </div>
            </div>
        </div>

        <!-- MODAL -->
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
    </section>

    <!-- ALPINE + ANIMASI JS -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const hero = document.getElementById("heroText");
            if (hero) {
                setTimeout(() => {
                    hero.classList.remove("opacity-0", "translate-x-[-50px]");
                    hero.classList.add("opacity-100", "translate-x-0");
                }, 300);
            }
        });
    </script>

    <!-- BLOOD STOCK SECTION -->
    <section id="blood_stock" class="py-12 bg-gradient-to-l from-red-100 via-gray-50 to-white-100">
        <div class="container mx-auto px-4">
            <h2 class="section-title tracking-widest pb-6 font-Poppins text-center text-3xl sm:text-4xl"
                data-aos="fade-down" data-aos-duration="1000">
                BLOODSTOCK
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Left: List Data -->
                <div class="space-y-4" data-aos="fade-right" data-aos-duration="1000">
                    <ul class="space-y-2 text-lg text-gray-700">
                        @foreach ($stok as $item)
                            <li class="flex items-center justify-between border-b pb-2 hover:bg-gray-50 transition duration-300 cursor-pointer"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <span class="font-medium">Blood type {{ $item->blood_type }}</span>
                                <span class="text-red-600">{{ $item->total_darah }} ML</span>
                            </li>
                        @endforeach
                    </ul>

                    @php
                        $totalDarah = $stok->sum('total_darah');
                    @endphp

                    <p class="text-xl font-semibold mt-4 pr-5" data-aos="fade-up"
                        data-aos-delay="{{ count($stok) * 100 }}">
                        Total Blood Stock: <span class="text-red-600">{{ $totalDarah }} ML</span>
                    </p>
                </div>

                <!-- Right: Donut Chart -->
                <div class="shadow-lg rounded-lg bg-white p-4 flex justify-center items-center"
                    style="width: 100%; height: 400px;" data-aos="zoom-in" data-aos-duration="1200">
                    <canvas id="donutChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Donut Chart Script -->
        <script>
            const ctx = document.getElementById('donutChart').getContext('2d');

            const centerText = {
                id: 'centerText',
                beforeDraw(chart, args, options) {
                    const {
                        width,
                        height,
                        ctx
                    } = chart;
                    ctx.restore();
                    const fontSize = (height / 120).toFixed(2);
                    ctx.font = `${fontSize}em sans-serif`;
                    ctx.textBaseline = 'middle';
                    ctx.fillStyle = '#ef4444';

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
                    animateScale: true,
                    easing: 'easeInOutQuart',
                    duration: 1500,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true,
                }
            };

            const donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options,
                plugins: [centerText]
            });
        </script>

        <!-- AOS Animate on Scroll -->
        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </section>




    <!-- === EDUCATION SECTION === -->
    <section id="education" class="py-12 px-4 bg-white">
        <div class="container mx-auto">
            <h2 class="section-title tracking-widest pb-6 font-Poppins text-center text-3xl sm:text-4xl">EDUCATION</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Item 1: Ibu Menyusui -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://lottie.host/8c30147f-e3e0-40cd-8d06-f9242013c63e/3lQaXJj0v1.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">Breastfeeding Mothers Are Prohibited From Donating Blood</p>
                </div>

                <!-- Item 2: Umur Minimal -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_zpjfsp1e.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">Minimum Age to Participate in Blood Donation is 16 Years and Above</p>
                </div>

                <!-- Item 3: Perokok -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://lottie.host/c690e32e-c6ae-4edb-944f-3cd448877751/3IPodRg1mv.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">People Who Smoke Frequently Are Prohibited From Donating Blood</p>
                </div>

                <!-- Item 4: Datang Bulan -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://lottie.host/3df58f2c-9c0f-4afc-873e-6597d1f106d6/lDpBdZGsmF.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">Women who are menstruating are prohibited from participating in blood donations</p>
                </div>

                <!-- Item 5: Berat Badan -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://lottie.host/dff74744-13aa-4ca6-87c4-0ad9b15c8214/nJzb1vV20c.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">For Men and Women Minimum Weight 47 Kg</p>
                </div>

                <!-- Item 6: Begadang -->
                <div class="education-item text-center animate-fade-up">
                    <lottie-player src="https://lottie.host/31536a31-043d-42b2-a7e5-9ba920297c43/PjdkwR9ne4.json"
                        background="transparent" speed="1" style="width: 150px; height: 150px; margin: 0 auto;"
                        loop autoplay></lottie-player>
                    <p class="text-gray-600 mt-4">It is Not Recommended to Stay Up Late If You Are Participating in Blood Donation Activities the Next Day
                        
                    </p>
                </div>

            </div>
        </div>
    </section>



    <!-- === FADE-UP CSS === -->
    <style>
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
            will-change: opacity, transform;
        }

        .fade-up.visible {
            opacity: 1;
            transform: none;
        }
    </style>

    <!-- === SCROLL ANIMATION JS === -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const items = document.querySelectorAll('.fade-up');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 150);
                    } else {
                        // Reset animasi ketika keluar dari layar
                        entry.target.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            items.forEach(item => observer.observe(item));
        });
    </script>



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
                        <li><a href="#home_page" class="hover:text-gray-300">Homepage</a></li>
                        <li><a href="#about_us" class="hover:text-gray-300">About Us</a></li>
                        <li><a href="#blood_stock" class="hover:text-gray-300">Bloodstock</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-gray-300">Contact Us</a></li>
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
