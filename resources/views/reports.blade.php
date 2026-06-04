@extends('layouts.app')
@section('title', 'Laporan Keuangan')
@section('header', 'Analisis Keuangan Interaktif')

@section('content')
    <!-- 1. Form Filter Bulan & Tahun -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
        <form action="{{ route('reports') }}" method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-1">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Pilih Bulan</label>
                <select name="month" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-gray-700 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">
                    @foreach([
                        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                    ] as $num => $name)
                        <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Pilih Tahun</label>
                <select name="year" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-gray-700 outline-none focus:ring-2 focus:ring-indigo-500 appearance-none">
                    @for($y = date('Y') - 2; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex gap-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-indigo-500/20">
                    Terapkan Filter
                </button>
                <a href="{{ route('reports.download', ['month' => $selectedMonth, 'year' => $selectedYear]) }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-red-500/20 text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Cetak PDF
                </a>
            </div>
        </form>
    </div>

    <!-- 2. Ringkasan Statistik Bulanan (KPI Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-400 uppercase font-semibold">Total Pengeluaran</p>
            <h3 class="text-xl font-bold text-red-500 mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-400 uppercase font-semibold">Jumlah Transaksi</p>
            <h3 class="text-xl font-bold text-gray-700 mt-1">{{ $trxCount }} Kali</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-400 uppercase font-semibold">Rata-rata Belanja</p>
            <h3 class="text-xl font-bold text-indigo-600 mt-1">Rp {{ number_format($averageSpending ?? 0, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-xs text-gray-400 uppercase font-semibold">Belanja Termahal</p>
            <h3 class="text-xl font-bold text-orange-500 mt-1">Rp {{ number_format($maxSingleTransaction ?? 0, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- 3. Progress Bar Grafik Batang Pengeluaran per Kategori -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-gray-700 mb-6 text-lg">Distribusi Pengeluaran Kategori</h3>
        
        @if($categoriesReport->sum('total_spent') > 0)
            <div class="space-y-6">
                @foreach($categoriesReport as $cat)
                    @if($cat->total_spent > 0)
                        <div>
                            <div class="flex justify-between items-center text-sm font-semibold text-gray-700 mb-1">
                                <span>{{ $cat->cat_name }}</span>
                                <span class="text-gray-500 font-medium">
                                    Rp {{ number_format($cat->total_spent, 0, ',', '.') }} 
                                    <span class="text-xs font-bold text-indigo-600 ml-2 bg-indigo-50 px-2 py-0.5 rounded-full">{{ $cat->percentage }}%</span>
                                </span>
                            </div>
                            <!-- Bar Visual Tailwind -->
                            <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-500 h-full rounded-full transition-all duration-500" 
                                     style="width: {{ $cat->percentage }}%"></div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-sm text-center py-8">Tidak ada data transaksi pengeluaran di periode ini.</p>
        @endif
    </div>
@endsection
