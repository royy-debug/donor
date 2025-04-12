<!DOCTYPE html>
<html>
<head>
    <title>Login Donor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center text-red-600 mb-6">login account Donor</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

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

            <button type="submit"
                    class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition-all">
                Login
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('register') }}" class="text-sm text-red-600 hover:underline">Don't have an account? Sign up</a>
        </div>
    </div>

</body>
</html>
