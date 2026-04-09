<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Data diambil langsung dari Database menggunakan Eloquent Model
        $categories = Category::all();

        return view('categories', compact('categories'));
    }
}
