<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data transaksi sekaligus meng-JOIN tabel kategori (Eager Loading)
        $transactions = Transaction::with('category')->get();

        return view('transactions', compact('transactions'));
    }
}
