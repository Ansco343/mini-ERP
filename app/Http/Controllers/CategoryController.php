<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function Category(){
        $category = Category::all();

        return view('categories', compact('category'));
    }

    public function Store(Request $request){
        $validated = $request->validate([
            'cat_name' => 'required|string|max:100|unique:categories,cat_name',
            'type' => 'required|in:income,expense'
        ]);

        Category::create($validated);

        return redirect()->route('cartegories')->with('success', 'Kategori Berhasil Ditambahkan!');
    }
}
