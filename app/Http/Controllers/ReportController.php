<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function downloadPdf(Request $request)
    {
        $selectedMonth = $request->get('month', date('m'));
        $selectedYear = $request->get('year', date('Y'));

        // 1. Ambil seluruh data transaksi pada bulan & tahun terpilih
        $transactions = Transaction::with('category')
            ->whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->orderBy('trans_date', 'asc')
            ->get();

        // 2. Hitung statistik agregat (Pemasukan, Pengeluaran, Saldo Bersih)
        $totalIncome = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->whereHas('category', fn($q) => $q->where('type', 'income'))
            ->sum('amount');

        $totalExpense = Transaction::whereMonth('trans_date', $selectedMonth)
            ->whereYear('trans_date', $selectedYear)
            ->whereHas('category', fn($q) => $q->where('type', 'expense'))
            ->sum('amount');

        $netDifference = $totalIncome - $totalExpense;

        // Mapping nama bulan Indonesia
        $months = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $monthName = $months[$selectedMonth] ?? 'Pilihan';

        // 3. Konfigurasi dan load view PDF khusus
        $pdf = Pdf::loadView('reports_pdf', compact(
            'transactions',
            'totalIncome',
            'totalExpense',
            'netDifference',
            'monthName',
            'selectedYear'
        ));

        // 4. Unduh file PDF secara otomatis di browser user
        return $pdf->download("Laporan_Keuangan_{$monthName}_{$selectedYear}.pdf");
    }
}
