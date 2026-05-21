<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Scheb\YahooFinanceApi\ApiClientFactory;
use App\Models\Transaction;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index(){
        // $data = [
        //     'total_saldo' => 10000000000,
        //     'pemasukan' => 1000000,
        //     'pengeluaran' => 50000,
        //     'recent_transaction' => [
        //         ['tanggal' => '01 Mar 2026', 'deskripsi' => 'Gaji Bulanan', 'nominal' => 500000, 'kategori' => 'Gaji', 'tipe' => 'income'],
        //         ['tanggal' => '02 Mar 2026', 'deskripsi' => 'Makan nasi padang', 'nominal' => 15000, 'kategori' => 'Makan', 'tipe' => 'expense'],
        //         ['tanggal' => '03 Mar 2026', 'deskripsi' => 'Donasi buat Wilbert laptop baru', 'nominal' => 1000000, 'kategori' => 'Sumbangan', 'tipe' => 'expense']
        //     ]
        // ];

        $pemasukkan = Transaction::whereHas('category', function($q){
            $q->where('type', 'income');
        })->sum('amount');

        $pengeluaran = Transaction::whereHas('category', function($q){
            $q->where('type', 'expense');
        })->sum('amount');

        // $test = Transaction::select();

        $total_saldo = $pemasukkan - $pengeluaran;

        $recent_transaction = Transaction::with('category')->latest('trans_date')->take(5)->get();

        $category = Category::all();

        //yahoo finance
        $symbol = 'TLKM.JK';
        $url = "https://query1.finance.yahoo.com/v8/finance/chart/{$symbol}";
        $response = Http::get($url);

        $lastPrice = '';

        if($response->successful()){
            $data = $response->json();

            $lastPrice = $data['chart']['result'][0]['meta']['regularMarketPrice'];
            $currency = $data['chart']['result'][0]['meta']['currency'];
        }

        // $client = ApiClientFactory::createApiClient();

        // // Fetch a single stock quote (e.g., Apple)
        // $quote = $client->getQuote("AAPL");
        // echo $quote->getRegularMarketPrice();

        // // Fetch historical data
        // $historicalData = $client->getHistoricalQuoteData(
        //     "AAPL",
        //     \Scheb\YahooFinanceApi\ApiClient::INTERVAL_1_DAY,
        //     new \DateTime("-30 days"),
        //     new \DateTime("today")
        // );

        return view('dashboard', compact('pemasukkan',
            'pengeluaran',
            'total_saldo',
            'recent_transaction',
            'category',
            'lastPrice',
            'currency',
            'symbol'));
    }
    
}
