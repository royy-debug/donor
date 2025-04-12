<!DOCTYPE html>
<html>
<head>
    <title>Register Donor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-red-600 mb-6">Registrasi Account</h1>

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
                <label class="block mb-1 text-gray-600">Name</label>
                <input type="text" name="name" required
                       class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Password</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 text-gray-600">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition-all">
                    Register & Login
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-sm text-red-600 hover:underline">Already have an account? Login</a>
        </div>
    </div>

</body>
</html>
