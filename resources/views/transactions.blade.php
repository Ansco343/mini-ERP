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
                <th class="px-6 py-4 text-sm font-semibold text-gray-600 text-center">Nota</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @foreach ($transactions as $transaction)
                <tr>
                <td class="px-6 py-4">{{$transaction->trans_date}}</td>
                <td class="px-6 py-4 font-medium">{{$transaction['desc']}}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 bg-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-100 text-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-700 rounded text-xs">{{$transaction->category->cat_name}}</span></td>
                <td class="px-6 py-4 text-right text-{{$transaction->category->type == 'income' ? 'green' : 'red'}}-600 font-bold">
                    {{$transaction->category->type == 'income' ? '+' : '-'}} Rp {{ number_format($transaction['amount'], 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-center">
                    @if ($transaction->receipt_path)
                        <a href="{{ route('transaction.receipt', $transaction->id) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1 text-sm font-semibold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Lihat
                        </a>
                    @else
                        <span class="text-gray-400 text-xs">-</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection