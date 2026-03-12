<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_saldo' => 5000000,
            'pemasukan' => 6500000,
            'pengeluaran' => 1500000,
            'recent_transactions' => [
                ['tanggal' => '01 Mar 2024', 'deskripsi' => 'Gaji Bulanan', 'nominal' => 5000000, 'kategori' => 'Pemasukan', 'tipe' => 'pemasukan'],
                ['tanggal' => '02 Mar 2024', 'deskripsi' => 'Bayar Kos', 'nominal' => -1500000, 'kategori' => 'Tempat Tinggal', 'tipe' => 'pengeluaran'],
                ['tanggal' => '05 Mar 2024', 'deskripsi' => 'Project Freelance', 'nominal' => 1500000, 'kategori' => 'Pemasukan', 'tipe' => 'pemasukan']
            ]
        ];

        return view('dashboard', $data);
    }
}
