@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Ringkasan Keuangan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-semibold">Total Saldo</p>
        <h3 class="text-2xl font-bold text-indigo-600">Rp 5.250.000</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-semibold text-green-500">Pemasukan Bulan Ini</p>
        <h3 class="text-2xl font-bold text-green-600">Rp 3.000.000</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 uppercase font-semibold text-red-500">Pengeluaran Bulan Ini</p>
        <h3 class="text-2xl font-bold text-red-600">Rp 750.000</h3>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-bold mb-4 text-gray-700">Transaksi Terakhir</h3>
    <p class="text-gray-400 text-sm">Belum ada transaksi terbaru.</p>
</div>
@endsection