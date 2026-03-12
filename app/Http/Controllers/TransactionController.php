<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = [
            ['tanggal' => '01 Mar 2024', 'deskripsi' => 'Gaji Bulanan', 'nominal' => 5000000, 'kategori' => 'Pemasukan', 'tipe' => 'pemasukan'],
            ['tanggal' => '02 Mar 2024', 'deskripsi' => 'Bayar Kos', 'nominal' => -1500000, 'kategori' => 'Tempat Tinggal', 'tipe' => 'pengeluaran'],
            ['tanggal' => '03 Mar 2024', 'deskripsi' => 'Beli Makan', 'nominal' => -50000, 'kategori' => 'Makanan', 'tipe' => 'pengeluaran'],
            ['tanggal' => '04 Mar 2024', 'deskripsi' => 'Bensin', 'nominal' => -30000, 'kategori' => 'Transportasi', 'tipe' => 'pengeluaran'],
            ['tanggal' => '05 Mar 2024', 'deskripsi' => 'Project Freelance', 'nominal' => 1500000, 'kategori' => 'Pemasukan', 'tipe' => 'pemasukan']
        ];

        return view('transactions', compact('transactions'));
    }
}
