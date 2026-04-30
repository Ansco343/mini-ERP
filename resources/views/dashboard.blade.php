@extends('layouts.app')
@section('title', 'Dashboard')
@section('header', 'Ringkasan Keuangan')


@section('content')
    {{-- Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm text-gray-500 uppercase font-semibold text">total saldo</P>
            <h3 class="text-2xl font-bold text-indigo-500">
                Rp {{ number_format($total_saldo, 2, ',', '.') }}
            </h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm uppercase font-semibold text text-green-500">Pemasukkan</P>
            <h3 class="text-2xl font-bold text-green-500">Rp {{ number_format($pemasukkan, 2, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
            <P class="text-sm uppercase font-semibold text text-red-500">Pengeluaran</P>
            <h3 class="text-2xl font-bold text-red-500">Rp {{ number_format($pengeluaran, 2, ',', '.') }}</h3>
        </div>
    </div>


    {{-- Add New --}}
    <div class="flex justify-between items-center mb-8">
        <button onclick="toggleModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition">
            + Tambah Transaksi
        </button>
    </div>

    {{-- Recent Transaction --}}
    <div class="bg-white p-6 rounded-xl shadow-sm font-semibold border border-gray-100">
        <h3 class="font-bold mb-4 text-gray-700">Transaksi Terkahir</h3>
        @if (count($recent_transaction) > 0)
            @foreach ($recent_transaction as $trx)
                <div class="flex justify-between items-center py-3 border-b border-gray-200">
                    <div>
                        <p class="font-medium text-gray-700">{{ $trx->desc }}</p>
                        <p class="text-xs text-gray-400">{{ $trx->trans_date }}</p>
                    </div>
                    <p class="font-bold text-{{ $trx->category->type == 'income' ? 'green' : 'red' }}-500">
                        Rp {{ number_format($trx->amount, 2, ',', '.') }}
                    </p>
                </div>
            @endforeach
        @else
            <p class="text-gray-400 text-sm">Belum ada History</p>
        @endif
    </div>

    {{-- Form Modal --}}
    <div id="modalTransaction" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div>
            <div>
                <h2>
                    Transaksi Baru
                </h2>
                <button onclick="toggleModal()">
                    &times;
                </button>
            </div>

            <form action="{{route('transaction.store')}}" method="POST">
                @csrf
                <div>
                    <div>
                        <label for="">Tanggal</label>
                        <input type="date" name="trans_date" id="" required>
                    </div>
                    <div>
                        <label for="">Deskripsi</label>
                        <input type="text" name="desc" required>
                    </div>
                    <div>
                        <label for="">Nominal</label>
                        <input type="number" name="amount" id="" required>
                    </div>
                    <div>
                        <label for="">Kategori</label>
                        <select name="category_id" id="">
                            @foreach ($category as $cat)
                                <option value="{{$cat->id}}"> {{$cat->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(){
            const modal = document.getElementById('modalTransaction');
            modal.classList.toggle('hidden');
        }
    </script>
@endsection
