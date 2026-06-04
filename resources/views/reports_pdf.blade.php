<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - {{ $monthName }} {{ $selectedYear }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            font-size: 12px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #4f46e5;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .summary-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .summary-table .label {
            font-weight: bold;
            background-color: #f9fafb;
            width: 35%;
        }
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .transaction-table th {
            background-color: #4f46e5;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        .transaction-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .type-income {
            color: green;
            font-weight: bold;
        }
        .type-expense {
            color: red;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>MONEYTRACK REPORT</h1>
        <p>Laporan Transaksi Periode: <strong>{{ $monthName }} {{ $selectedYear }}</strong></p>
    </div>

    <h3>Rangkuman Keuangan</h3>
    <table class="summary-table">
        <tr>
            <td class="label">Total Pemasukan</td>
            <td class="type-income">Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Total Pengeluaran</td>
            <td class="type-expense">Rp {{ number_format($totalExpense, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Selisih Bersih (Net)</td>
            <td style="font-weight: bold; color: {{ $netDifference >= 0 ? 'green' : 'red' }}">
                Rp {{ number_format($netDifference, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <h3>Rincian Riwayat Transaksi</h3>
    <table class="transaction-table">
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 40%;">Deskripsi</th>
                <th style="width: 25%;">Kategori</th>
                <th style="width: 20%;" class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trx)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($trx->trans_date)) }}</td>
                    <td>{{ $trx->desc }}</td>
                    <td>{{ $trx->category->cat_name }}</td>
                    <td class="text-right {{ $trx->category->type == 'income' ? 'type-income' : 'type-expense' }}">
                        {{ $trx->category->type == 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; color: #888; padding: 20px;">
                        Tidak ada transaksi tercatat pada periode ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak otomatis oleh MoneyTrack System pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

</body>
</html>
