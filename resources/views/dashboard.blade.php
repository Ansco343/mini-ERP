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
<<<<<<< HEAD
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
=======
                <div class="space-y-6">
                    <!-- Tanggal -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Tanggal</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <!-- Tambahkan value old() -->
                            <input type="date" name="trans_date" value="{{ old('trans_date') }}" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 outline-none">
                        </div>
                        <!-- Pesan Error -->
                        @error('trans_date')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Deskripsi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <input type="text" name="desc" placeholder="Contoh: Belanja Bulanan" value="{{ old('desc') }}" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 outline-none">
                        </div>
                        @error('desc')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid for Nominal and Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nominal -->
                        <div class="relative">
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Nominal (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-medium">Rp</span>
                                </div>
                                <input type="number" name="amount" placeholder="0" value="{{ old('amount') }}" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 outline-none">
                            </div>
                            @error('amount')
                                <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="relative">
                            <label class="text-sm font-semibold text-gray-700 mb-1 block">Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <select name="category_id" required class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 appearance-none outline-none">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($category as $cat)
                                        <option value="{{$cat->id}}" {{ old('category_id') == $cat->id ? 'selected' : '' }}> {{$cat->cat_name}}</option>
                                    @endforeach
                                </select>
                                <!-- Custom Chevron -->
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('category_id')
                                <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>
>>>>>>> parent of 242eff8 (materi week 8)
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

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hilangkan class 'hidden' dari modal secara paksa saat layar berhasil diload ulang
            document.getElementById('modalTransaction').classList.remove('hidden');
        });
    </script>
    @endif
@endsection
