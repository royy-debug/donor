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

                {{-- Hidden user_id --}}
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="grid sm:grid-cols-2 gap-5">
                    <!-- NIK -->
                    <div>
                        <label class="text-sm font-medium">NIK</label>
                        <input
                            type="text"
                            name="nik"
                            maxlength="16"
                            required
                            placeholder="16 digit NIK"
                            value="{{ old('nik') }}"
                            class="mt-1 w-full px-4 py-2 border @error('nik') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                        @error('nik')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="text-sm font-medium">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="Nama sesuai KTP"
                            value="{{ old('name') }}"
                            class="mt-1 w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="text-sm font-medium">Jenis Kelamin</label>
                        <div class="flex items-center mt-2 space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="gender" value="M" required class="accent-red-600" {{ old('gender')=='M'? 'checked':'' }}>
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="gender" value="F" required class="accent-red-600" {{ old('gender')=='F'? 'checked':'' }}>
                                <span>Perempuan</span>
                            </label>
                        </div>
                        @error('gender')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Golongan Darah -->
                    <div>
                        <label class="text-sm font-medium">Golongan Darah</label>
                        <select
                            name="blood_type"
                            required
                            class="mt-1 w-full px-4 py-2 border @error('blood_type') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                            <option value="">Pilih Golongan</option>
                            @foreach(['A','B','AB','O'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type')==$type?'selected':'' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('blood_type')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor HP -->
                    <div>
                        <label class="text-sm font-medium">Nomor HP</label>
                        <input
                            type="text"
                            name="phone"
                            required
                            placeholder="08xxxxxxxxxx"
                            value="{{ old('phone') }}"
                            class="mt-1 w-full px-4 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                        @error('phone')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email (otomatis dari user) -->
                    <div>
                        <label class="text-sm font-medium">Email</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            readonly
                            class="mt-1 w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed"
                        >
                    </div>

                    <!-- Berat Badan -->
                    <div>
                        <label class="text-sm font-medium">Berat Badan <span class="text-xs text-gray-500">(kg)</span></label>
                        <input
                            type="number"
                            name="weight"
                            required
                            placeholder="Contoh: 60"
                            value="{{ old('weight') }}"
                            class="mt-1 w-full px-4 py-2 border @error('weight') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                        @error('weight')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Darah -->
                    <div>
                        <label class="text-sm font-medium" title="Min: 100 ml, Maks: 500 ml">Jumlah Darah (ml)</label>
                        <input
                            type="number"
                            name="blood_count"
                            min="100"
                            max="500"
                            required
                            placeholder="Contoh: 350"
                            value="{{ old('blood_count') }}"
                            class="mt-1 w-full px-4 py-2 border @error('blood_count') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-red-500 focus:outline-none"
                        >
                        @error('blood_count')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Upload KTP -->
                <div>
                    <label class="text-sm font-medium">Upload KTP (maks 2MB)</label>
                    <input
                        type="file"
                        name="ktp_file"
                        accept="image/*"
                        required
                        class="mt-2 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-white file:bg-red-600 hover:file:bg-red-700 focus:outline-none"
                    >
                    @error('ktp_file')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pre-screening Questions -->
                <div class="grid sm:grid-cols-3 gap-5">
                    @foreach ([
                        'is_healthy'          => ['label' => 'Anda Sehat?',            'yes' => 1, 'no' => 0],
                        'has_disease_history' => ['label' => 'Riwayat Penyakit Berat?', 'yes' => 1, 'no' => 0],
                        'slept_well'          => ['label' => 'Tidur Cukup (6–8 jam)?',  'yes' => 1, 'no' => 0],
                    ] as $field => $opts)
                        <div>
                            <label class="text-sm font-medium">{{ $opts['label'] }}</label>
                            <div class="flex items-center mt-2 space-x-4">
                                <label class="flex items-center space-x-1">
                                    <input
                                        type="radio"
                                        name="{{ $field }}"
                                        value="{{ $opts['yes'] }}"
                                        required
                                        class="accent-red-600"
                                        {{ old($field)==$opts['yes'] ? 'checked' : '' }}
                                    >
                                    <span>Ya</span>
                                </label>
                                <label class="flex items-center space-x-1">
                                    <input
                                        type="radio"
                                        name="{{ $field }}"
                                        value="{{ $opts['no'] }}"
                                        required
                                        class="accent-red-600"
                                        {{ old($field)==$opts['no'] ? 'checked' : '' }}
                                    >
                                    <span>Tidak</span>
                                </label>
                            </div>
                            @error($field)
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <!-- Submit -->
                <div class="text-center pt-6">
                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-8 rounded-lg shadow-md transition-all duration-300"
                    >
                        Submit &amp; Dapatkan QR Code
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
