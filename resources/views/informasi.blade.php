<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Terkini - Donor Darah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    {{-- <nav class="bg-red-600 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('utama') }}" class="font-bold text-xl">Donor Darah</a>
            <div class="space-x-6">
                <a href="{{ route('utama') }}" class="hover:underline">Beranda</a>
                <a href="{{ route('informasi') }}" class="hover:underline">Informasi</a>
                <a href="{{ route('contact') }}" class="hover:underline">Kontak</a>
            </div>
        </div>
    </nav> --}}

    <!-- Header -->
    <header class="text-center py-12 bg-white shadow">
        <h1 class="text-4xl font-bold text-red-600">Informasi & Kegiatan Terbaru</h1>
        <p class="text-gray-600 mt-4">Berbagai kegiatan donor darah dan info penting lainnya</p>
    </header>

    <!-- Galeri Kegiatan -->
    <main class="container mx-auto py-12 flex-grow">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/info1.svg') }}" alt="Kegiatan Donor 1" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Donor Darah di Lapangan Merdeka</h2>
                    <p class="text-gray-700 text-sm">Ratusan relawan antusias mengikuti donor darah di acara komunitas peduli sesama.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/info2.svg') }}" alt="Kegiatan Donor 2" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Aksi Donor Darah di Kampus</h2>
                    <p class="text-gray-700 text-sm">Mahasiswa bersama PMI mengadakan kegiatan donor darah, terkumpul lebih dari 200 kantong darah.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/info3.svg') }}" alt="Kegiatan Donor 3" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Donor Darah di Mall Kota</h2>
                    <p class="text-gray-700 text-sm">Masyarakat berpartisipasi dalam kegiatan donor darah di pusat perbelanjaan.</p>
                </div>
            </div>

            <!-- Tambah Kartu Lagi -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/4.jpg') }}" alt="Kegiatan Donor 4" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Donor Darah di Kantor Desa</h2>
                    <p class="text-gray-700 text-sm">Warga desa dengan antusias mendonorkan darah di acara bakti sosial yang diadakan PMI.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/info3.svg') }}" alt="Kegiatan Donor 5" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Donor Darah di Kantor Desa</h2>
                    <p class="text-gray-700 text-sm">Warga desa dengan antusias mendonorkan darah di acara bakti sosial yang diadakan PMI.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                <img src="{{ asset('images/info1.svg') }}" alt="Kegiatan Donor 6" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-red-600 mb-2">Donor Darah di Kantor Desa</h2>
                    <p class="text-gray-700 text-sm">Warga desa dengan antusias mendonorkan darah di acara bakti sosial yang diadakan PMI.</p>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-12">
            <a href="{{ route('utama') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-red-600 p-4 text-white text-center">
        &copy; {{ date('Y') }} Aplikasi Donor Darah
    </footer>

</body>
</html>
