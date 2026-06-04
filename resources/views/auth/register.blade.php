<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MoneyTrack</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-xl w-full max-w-md m-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Buat Akun Baru</h2>
            <p class="text-sm text-gray-400 mt-2">Mulai pantau arus kas Anda secara aman</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-gray-700">
                @error('name')
                    <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
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
                @error('password')
                    <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition text-gray-700">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-3.5 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/20">
                Daftar Akun
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk</a>
        </p>
    </div>
</body>
</html>
