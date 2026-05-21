@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('header', 'Kategori Transaksi')

@section('content')
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm md:col-span-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @forelse ($category as $cat)
            <div class="p-4 bg-white rounded-lg border-l-4 border-{{$cat['type'] == 'income' ? 'blue' : 'orange'}}-500 shadow-sm flex items-center justify-between">
                <span class="font-bold text-gray-700"> {{$cat['cat_name']}}</span>
                <button class="text-gray-400 hover:text-red-500">Edit</button>
            </div>
        @empty
            <p class="text-gray-400 text-sm md:col-span-4 text-center py-6">Belum ada kategori transaksi.</p>
        @endforelse
        <button onclick="toggleModalCategory()"
            class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-indigo-500 hover:text-indigo-500 transition">
            + Tambah Kategori
        </button>
    </div>

    {{-- Modal Category Creation --}}
    <div id="modalCategory" class="fixed inset-0 bg-gray-900/40 backdrop-blur-md hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white border border-gray-100 rounded-3xl shadow-2xl w-full max-w-md p-8 m-4 transform transition-all duration-300 scale-100">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Kategori Baru
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">Tambahkan pengelompokan transaksi baru</p>
                </div>
                <button onclick="toggleModalCategory()" class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-full transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('cartegories.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <!-- Nama Kategori -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Nama Kategori</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            </div>
                            <input type="text" name="cat_name" value="{{ old('cat_name') }}" placeholder="Contoh: Hiburan, Kesehatan" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 outline-none">
                        </div>
                        @error('cat_name')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipe Kategori -->
                    <div class="relative">
                        <label class="text-sm font-semibold text-gray-700 mb-1 block">Tipe Transaksi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <select name="type" required class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-gray-700 appearance-none outline-none font-medium">
                                <option value="" disabled selected>Pilih Tipe</option>
                                <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Pemasukan (Income)</option>
                                <option value="expense" {{ old('type') == 'expense' ? 'selected' : '' }}>Pengeluaran (Expense)</option>
                            </select>
                            <!-- Custom Chevron -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('type')
                            <p class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold py-4 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:-translate-y-1 hover:shadow-lg shadow-indigo-500/30 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModalCategory(){
            const modal = document.getElementById('modalCategory');
            modal.classList.toggle('hidden');
        }
    </script>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('modalCategory').classList.remove('hidden');
            });
        </script>
    @endif
@endsection
