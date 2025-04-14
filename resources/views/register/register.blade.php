<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Donor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 min-h-screen flex items-start justify-center pt-20 sm:pt-16">

    <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md w-full max-w-sm sm:max-w-md md:max-w-lg mt-[-20px] sm:mt-[-40px]">
        <h1 class="text-2xl font-bold text-center text-red-600 mb-6">Registrasi Akun Donor</h1>

        <!-- Error message -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 text-gray-600">Nama Lengkap</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition-all">
                Register & Login
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-red-600 hover:underline">Sudah punya akun? Masuk di sini</a>
        </div>
    </div>

</body>
</html>
