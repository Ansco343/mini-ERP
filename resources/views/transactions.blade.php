@extends('layouts.app')

@section('title', 'Daftar Transaksi')
@section('header', 'Riwayat Transaksi')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Tanggal</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Deskripsi</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600">Kategori</th>
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-right">Nominal</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($transactions as $trx)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">{{ $trx->tanggal }}</td>
                <td class="px-6 py-4 font-medium">{{ $trx->deskripsi }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 {{ $trx->tipe == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded text-xs">
                        {{ $trx->category->nama ?? 'Tanpa Kategori' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right text-{{ $trx->tipe == 'pemasukan' ? 'green' : 'red' }}-600 font-bold">
                    {{ $trx->tipe == 'pemasukan' ? '+' : '-' }} Rp {{ number_format(abs($trx->nominal), 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-gray-500 py-4">Belum ada data transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection