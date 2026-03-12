<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function willy(){
        $category = [
            ['name' => 'Makanan', 'tipe' => 'expense'],
            ['name' => 'Transportasi', 'tipe' => 'expense'],
            ['name' => 'Gaji', 'tipe' => 'income'],
            ['name' => 'Sewa Rumah', 'tipe' => 'expense'],
            ['name' => 'Donasi', 'tipe' => 'expense'],
        ];

        return view('categories', compact('category'));
    }
}
