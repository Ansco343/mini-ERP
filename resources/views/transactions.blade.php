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
            {{-- <tr>
                <td class="px-6 py-4">01 Mar 2024</td>
                <td class="px-6 py-4 font-medium">Gaji Bulanan</td>
                <td class="px-6 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Pemasukan</span></td>
                <td class="px-6 py-4 text-right text-green-600 font-bold">+ Rp 5.000.000</td>
            </tr>
            <tr>
                <td class="px-6 py-4">02 Mar 2024</td>
                <td class="px-6 py-4 font-medium">Bayar Kos</td>
                <td class="px-6 py-4"><span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs">Tempat Tinggal</span></td>
                <td class="px-6 py-4 text-right text-red-600 font-bold">- Rp 1.500.000</td>
            </tr> --}}

            @foreach ($transactions as $transaction)
                <tr>
                <td class="px-6 py-4">{{$transaction->trans_date}}</td>
                <td class="px-6 py-4 font-medium">{{$transaction['desc']}}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 bg-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-100 text-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-700 rounded text-xs">{{$transaction->category->cat_name}}</span></td>
                <td class="px-6 py-4 text-right text-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-600 font-bold">{{$transaction['amount']}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection