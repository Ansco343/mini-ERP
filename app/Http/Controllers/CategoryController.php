<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            ['nama' => 'Makanan', 'warna' => 'orange'],
            ['nama' => 'Transportasi', 'warna' => 'blue'],
            ['nama' => 'Pemasukan', 'warna' => 'green'],
            ['nama' => 'Tempat Tinggal', 'warna' => 'red']
        ];

        return view('categories', compact('categories'));
    }
}
