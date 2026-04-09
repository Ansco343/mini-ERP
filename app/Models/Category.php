<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mengizinkan field ini untuk diisi melalui form (Mass Assignment)
    protected $fillable = ['nama', 'tipe'];

    // Relasi: Satu Kategori memiliki banyak Transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
