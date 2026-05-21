<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MoneyTrack</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-xl w-full max-w-md m-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">MoneyTrack Login</h2>
            <p class="text-sm text-gray-400 mt-2">Kelola keuangan Anda secara profesional</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-gray-700">
                @error('email')
                    <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Password</label>
                <input type="password" name="password" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-gray-700">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-3.5 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/20">
                Masuk ke Aplikasi
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</body>
</html>
