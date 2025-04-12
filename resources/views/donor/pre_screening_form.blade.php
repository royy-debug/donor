<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pre-Screening Donor Darah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-red-50 text-gray-700">
    <section class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-3xl bg-white px-8 py-10 rounded-2xl shadow-md border border-red-100">

            <h1 class="text-2xl sm:text-3xl font-semibold text-center text-red-600 mb-8">
                Pre-Screening Donor Darah
            </h1>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded bg-red-100 text-red-800 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('donor.prescreen.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid sm:grid-cols-2 gap-5">
                    <!-- NIK -->
                    <div>
                        <label class="text-sm font-medium">NIK</label>
                        <input type="text" name="nik" maxlength="16" required placeholder="16 digit NIK"
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="text-sm font-medium">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="text-sm font-medium">Jenis Kelamin</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="gender" value="M" required class="accent-red-600">
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="gender" value="F" required class="accent-red-600">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Golongan Darah -->
                    <div>
                        <label class="text-sm font-medium">Golongan Darah</label>
                        <select name="blood_type" required
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                            <option value="">Pilih Golongan</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="text-sm font-medium">Nomor HP</label>
                        <input type="text" name="phone" required placeholder="08xxxxxxxxxx"
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <input type="email" name="email" required
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label class="text-sm font-medium">Berat Badan <span class="text-xs text-gray-500">(kg)</span></label>
                        <input type="number" name="weight" placeholder="Contoh: 60"
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>

                    <!-- Jumlah Darah -->
                    <div>
                        <label class="text-sm font-medium" title="Minimal 100 ml, maksimal 500 ml">Jumlah Darah (ml)</label>
                        <input type="number" name="blood_count" min="100" max="500" required placeholder="Contoh: 350"
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:outline-none">
                    </div>
                </div>

                <!-- Upload KTP -->
                <div>
                    <label class="text-sm font-medium">Upload KTP (maks 2MB)</label>
                    <input type="file" name="ktp_file" accept="image/*" required
                        class="mt-2 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:rounded-md file:border-0
                        file:text-white file:bg-red-600 hover:file:bg-red-700 focus:outline-none">
                </div>

                <!-- Pre-screening Questions -->
                <div class="grid sm:grid-cols-3 gap-5">
                    <div>
                        <label class="text-sm font-medium">Anda Sehat?</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="is_healthy" value="1" required class="accent-red-600">
                                <span>Ya</span>
                            </label>
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="is_healthy" value="0" required class="accent-red-600">
                                <span>Tidak</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Riwayat Penyakit Berat?</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="has_disease_history" value="0" required class="accent-red-600">
                                <span>Tidak Ada</span>
                            </label>
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="has_disease_history" value="1" required class="accent-red-600">
                                <span>Ada</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium">Tidur Cukup (6-8 jam)?</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="slept_well" value="1" required class="accent-red-600">
                                <span>Ya</span>
                            </label>
                            <label class="flex items-center space-x-1">
                                <input type="radio" name="slept_well" value="0" required class="accent-red-600">
                                <span>Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-center pt-6">
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-all duration-300">
                        Submit & Dapatkan QR Code
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
