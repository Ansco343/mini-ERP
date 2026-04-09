<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            ['nama' => 'Makanan', 'tipe' => 'expense'],
            ['nama' => 'Transportasi', 'tipe' => 'expense'],
            ['nama' => 'Pemasukan', 'tipe' => 'income'],
            ['nama' => 'Tempat Tinggal', 'tipe' => 'expense'],
            ['nama' => 'Tempat Tinggal', 'tipe' => 'expense']
        ];

        return view('categories', compact('categories'));
    }
}
