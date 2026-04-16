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
        <aside class="w-64 bg-linear-to-tr from-green-500 via-indigo-500  to-pink-500 text-white shrink-0 hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold italic">
                MoneyTrack
            </div>
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Dashboard</a>
                <a href="{{ route('transaction')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Transaction</a>
                <a href="{{ route('cartegories')}}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-indigo-600">Category</a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    @yield('header')
                </h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">Halo, Roger</span>
                    <div class="w-10 h-10 rounded-full bg-amber-700"></div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>