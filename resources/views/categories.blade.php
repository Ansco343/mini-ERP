@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('header', 'Kategori Transaksi')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    @foreach($categories as $cat)
    <div class="p-4 bg-white rounded-lg border-l-4 {{ 
        $cat->tipe == 'expense' ? 'border-orange-500' : 'border-blue-500'
    }} shadow-sm flex items-center justify-between">
        <span class="font-bold text-gray-700">{{ $cat->nama }}</span>
        <button class="text-gray-400 hover:text-red-500">Edit</button>
    </div>
    @endforeach
    <button class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-indigo-500 hover:text-indigo-500 transition">
        + Tambah Kategori
    </button>
</div>
@endsection