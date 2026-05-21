@extends('layouts.app')
@section('title', 'Laporan Keuangan')
@section('header', 'Analisis Keuangan Interaktif')

@section('content')
    <div>
        <form action="">
            <div>
                <label for="">
                    Pilih Bulan
                </label>
                <select name="month" id="">
                    @foreach (['01' => ' Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei'] as $num => $name)
                        <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : ''}}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">
                    Pilih Tahun
                </label>
                <select name="year" id="">
                    @for ($y = date('Y') - 2; $y <= date('Y'); $y++)
                        <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : ''}}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit">
                Terapkan Filter
            </button>
        </form>

        <div>
            <div>
                <p>Total Pengeluaran</p>
                <h3>Rp. {{ number_format($totalExpense, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
@endsection