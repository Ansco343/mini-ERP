<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Mengizinkan field ini untuk diisi melalui form (Mass Assignment)
    protected $fillable = ['tanggal', 'deskripsi', 'nominal', 'tipe', 'category_id'];

    // Relasi: Transaksi ini milik sebuah Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
