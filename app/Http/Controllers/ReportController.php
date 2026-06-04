<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Dapatkan filter bulan dan tahun dari input user (Default ke bulan & tahun sekarang)
        $selectedMonth = $request->get('month', date('m'));
        $selectedYear = $request->get('year', date('Y'));

        // 2. AGREGASI 1: Hitung total seluruh pengeluaran (Expense) pada bulan terpilih
        $totalExpense = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->whereHas('category', function($q) {
                $q->where('type', 'expense');
            })
            ->sum('amount');

        // 3. AGREGASI 2: Ambil pengeluaran per Kategori beserta Persentasenya (Menggunakan withSum)
        $categoriesReport = Category::where('type', 'expense')
            ->withSum(['transaction as total_spent' => function($query) use ($selectedMonth, $selectedYear) {
                $query->whereMonth('trans_date', $selectedMonth)
                      ->whereYear('trans_date', $selectedYear);
            }], 'amount')
            ->get()
            ->map(function($cat) use ($totalExpense) {
                // Hitung persentase kontribusi pengeluaran kategori ini terhadap total pengeluaran
                $cat->percentage = $totalExpense > 0 ? round(($cat->total_spent / $totalExpense) * 100) : 0;
                return $cat;
            })
            ->sortByDesc('total_spent');

        // 4. AGREGASI 3: Hitung KPI Statistik Bulanan
        $trxCount = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->count();

        $averageSpending = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->whereHas('category', function($q) {
                $q->where('type', 'expense');
            })
            ->avg('amount');

        $maxSingleTransaction = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->whereHas('category', function($q) {
                $q->where('type', 'expense');
            })
            ->max('amount');

        // 5. Kirim data ke View
        return view('reports', compact(
            'categoriesReport', 
            'totalExpense', 
            'trxCount', 
            'averageSpending', 
            'maxSingleTransaction', 
            'selectedMonth', 
            'selectedYear'
        ));
    }
}
