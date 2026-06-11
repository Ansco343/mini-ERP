<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = ['trans_date', 'desc', 'amount', 'category_id', 'receipt_path'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
