<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingProduk extends Model
{
    protected $fillable = ["produk_id", "transaksi_total_id", "user_id", "komentar", "rating"];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
