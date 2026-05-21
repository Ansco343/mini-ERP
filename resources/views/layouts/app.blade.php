<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - MoneyTrack</title>
    @vite('resources/css/app.css')
    {{-- @vite('resources/js/app.js') --}}
</head>
<body class="bg-gray-50 font-sans text-gray-900">
    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-linear-to-tr from-green-500 via-indigo-500 to-pink-500 text-white shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold italic">
                MoneyTrack
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Dashboard</a>
                <a href="{{ route('transaction')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Transaction</a>
                <a href="{{ route('cartegories')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Category</a>
                <a href="{{ route('reports')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Report</a>
            </nav>
            <!-- Logout Button Form -->
            <div class="p-4 border-t border-white/20">
                <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-white hover:bg-red-600 rounded transition duration-200 font-semibold text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    @yield('header')
                </h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Halo, {{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-amber-700 flex items-center justify-center text-white font-bold uppercase shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>