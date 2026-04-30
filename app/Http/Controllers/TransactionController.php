<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionController extends Controller
{
    public function Transaction(){
        $transactions = Transaction::latest('trans_date')->get();

        return view('transactions', compact('transactions'));
    }

    public function Store(Request $request){
        // dd($request);
        $validated = $request->validate([
            'trans_date' => 'required|date',
            'desc' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);
        Transaction::create($validated);

        return redirect()->route('transaction')->with('success', 'Transaksi Berhasil Ditambahkan!');
    }
}
