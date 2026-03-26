@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('header', 'Kategori Transaksi')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        {{-- <div class="p-4 bg-white rounded-lg border-l-4 border-orange-500 shadow-sm flex items-center justify-between">
        <span class="font-bold text-gray-700">Makanan</span>
        <button class="text-gray-400 hover:text-red-500">Edit</button>
    </div>
    <div class="p-4 bg-white rounded-lg border-l-4 border-blue-500 shadow-sm flex items-center justify-between">
        <span class="font-bold text-gray-700">Transportasi</span>
        <button class="text-gray-400 hover:text-red-500">Edit</button>
    </div> --}}
        @forelse ($category as $cat)
            <div class="p-4 bg-white rounded-lg border-l-4 border-{{$cat['tipe'] == 'income' ? 'green' : 'orange'}}-500 shadow-sm flex items-center justify-between">
                <span class="font-bold text-gray-700"> {{$cat['name']}}</span>
                <button class="text-gray-400 hover:text-red-500">Edit</button>
            </div>
        @empty
            {{-- <p class="text-gray-400 font-bold"> Belum ada kategori</p> --}}
        @endforelse
        <button
            class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-indigo-500 hover:text-indigo-500 transition">
            + Tambah Kategori
        </button>
    </div>
@endsection
