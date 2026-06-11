<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function Transaction(){
        $transactions = Transaction::latest('trans_date')->get();

        return view('transactions', compact('transactions'));
    }

    public function Store(Request $request){
        $validated = $request->validate([
            'trans_date' => 'required|date',
            'desc' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'receipt' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048'
        ]);

        if ($request->hasFile('receipt')) {
            $path = $request->file('receipt')->store('receipts');
            $validated['receipt_path'] = $path;
        }

        Transaction::create($validated);

        return redirect()->route('transaction')->with('success', 'Transaksi Berhasil Ditambahkan!');
    }

    public function showReceipt(Transaction $transaction)
    {
        if (!$transaction->receipt_path || !Storage::exists($transaction->receipt_path)) {
            abort(404);
        }
        
        return response()->file(Storage::path($transaction->receipt_path));
    }
}
