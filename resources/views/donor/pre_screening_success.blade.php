<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Donor Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white text-gray-700">

    <section class="min-h-screen flex items-center justify-center bg-red-50 px-4 py-10">
        <div class="w-full max-w-5xl bg-white px-6 py-6 rounded-lg shadow-lg border border-red-100 text-center">

            <!-- Heading -->
            <h1 class="text-3xl font-bold text-red-600 mb-8">
                Terima kasih, {{ $donor->name }}!
            </h1>

            <!-- Status -->
            @if ($donor->status === 'pending')
                <p class="text-yellow-600 font-semibold mb-6">
                    Data Anda sedang dalam proses verifikasi. Silakan cek kembali nanti untuk melihat statusnya.
                </p>
            @elseif ($donor->status === 'rejected')
                <p class="text-red-600 font-semibold mb-6">
                    Mohon maaf, data Anda tidak disetujui. Silakan hubungi admin untuk informasi lebih lanjut.
                </p>
            @elseif ($donor->status === 'approved')
                <p class="text-gray-700 mb-6">
                    Data Anda telah disetujui. Berikut adalah QR Code Anda:
                </p>

                <!-- QR Code -->
                <div class="flex justify-center mb-6">
                    {!! $qrCode !!}
                </div>

                <!-- KTP File -->
                @if ($donor->ktp_file)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $donor->ktp_file) }}" alt="KTP Donor"
                            class="w-64 border rounded shadow">
                    </div>
                @endif

                <p class="text-gray-700 mb-6">
                    Silakan tunjukkan QR Code ini kepada petugas saat datang ke lokasi donor darah.
                </p>
            @endif

            <!-- Button ke Home -->
            <a href="{{ route('utama') }}"
                class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300">
                Kembali ke Beranda
            </a>

        </div>
    </section>

</body>

</html>
