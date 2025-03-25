<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white text-gray-700">
    

    <section class="min-h-screen flex items-center justify-center bg-red-50 px-4 py-10">
        <div class="w-full max-w-5xl bg-white px-6 py-6 rounded-lg shadow-lg border border-red-100 text-center">

            <!-- Heading -->
            <h1 class="text-3xl font-bold text-red-600 mb-8">
                Terima kasih, {{ $donor->name }}!
            </h1>

            <!-- Description -->
            <p class="text-gray-700 mb-6">
                Data Anda telah berhasil kami terima. Berikut adalah QR Code Anda:
            </p>

            <!-- QR Code -->
            <div class="flex justify-center mb-6">
                {!! $qrCode !!}
            </div>
            @if ($donor->ktp_file)
    <div class="flex justify-center mb-6">
        <img src="{{ asset('storage/' . $donor->ktp_file) }}" alt="KTP Donor" class="w-64 border rounded shadow">
    </div>
@endif

            <!-- Instruction -->
            <p class="text-gray-700 mb-6">
                Silakan tunjukkan QR Code ini kepada petugas saat datang ke lokasi donor darah.
            </p>

            <!-- Button ke Home -->
            <a href="{{ route('utama') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300">
                Kembali ke Beranda
            </a>

        </div>
    </section>

</body>

</html>
