<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Screening Donor Darah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>



<body class="bg-white text-gray-700">

    <section class="min-h-screen flex items-center justify-center bg-red-50 px-4 py-10">
        <div class="w-full max-w-5xl bg-white px-6 py-6 rounded-lg shadow-lg border border-red-100">

            <h1 class="text-3xl font-bold text-center text-red-600 mb-8">
                Form Pre-Screening Donor Darah
            </h1>
            
        {{-- ERROR MESSAGES GLOBAL --}}
        @if ($errors->any())
        <div class="mb-6 p-4 rounded bg-red-100 text-red-800">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    
        
            <form action="{{ route('donor.prescreen.submit') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
        
            <!-- Nama -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                    @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                </div>
        
            <!-- Gender -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                <select name="gender" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                    <option value="">Pilih Gender</option>
                    <option value="M">Laki-laki</option>
                    <option value="F">Perempuan</option>
                </select>

            </div>
        
            <!-- Golongan Darah -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                <select name="blood_type" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                    <option value="">Pilih Golongan Darah</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>
        
            <!-- Rhesus -->
            <!-- No Handphone -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">No Handphone</label>
                <input type="text" name="phone" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        
            <!-- Email -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        
            <!-- Berat Badan -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (Kg)</label>
                <input type="number" name="weight"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        
            <!-- Alamat -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="address" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
            </div>
        
            <!-- Jumlah Darah -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Darah yang Didonorkan (ml)</label>
                <input type="number" name="blood_count" min="100" max="500" required
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
            </div>
        
            <!-- Upload KTP -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload KTP (JPG/PNG, max 2MB)</label>
                <input type="file" name="ktp_file" accept="image/*" required
                    class="w-full h-32 px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none
                    file:mr-4 file:py-4 file:px-6 file:rounded file:border-0 file:text-base file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700">
                    <img id="preview_ktp" class="mt-4 w-64 border rounded hidden">

            </div>
        
            <!-- Pre-Screening -->
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apakah Anda Sehat?</label>
                        <select name="is_healthy" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
        
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tidak ada riwayat penyakit berat?</label>
                        <select name="has_disease_history" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="0">Tidak Ada</option>
                            <option value="1">Ada</option>
                        </select>
                        @error('has_disease_history')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    </div>
        
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sudah tidur cukup (6-8 jam)?</label>
                        <select name="slept_well" required
                            class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                @error('slept_well')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
            </div>
        
            <!-- Submit -->
            <div class="md:col-span-2 text-center">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300">
                    Submit & Dapatkan QR Code
                </button>
            </div>
        </form>
        

        </div>
    </section>

</body>


</html>
