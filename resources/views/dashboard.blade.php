@extends('layouts.app')
@section('title', 'Dashboard')
@section('header', 'Ringkasan Keuangan')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm text-gray-500 uppercase font-semibold text">total saldo</P>
            <h3 class="text-2xl font-bold text-indigo-500">Rp 5,000,000</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm uppercase font-semibold text text-green-500">Pemasukkan</P>
            <h3 class="text-2xl font-bold text-green-500">Rp 5,000,000</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm uppercase font-semibold text text-red-500">Pengeluaran</P>
            <h3 class="text-2xl font-bold text-red-500">Rp 5,000,000</h3>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
        <h3 class="font-bold mb-4 text-gray-700">Transaksi Terkahir</h3>
        <p class="text-gray-400 text-sm">Belum ada History</p>
    </div>
@endsection
