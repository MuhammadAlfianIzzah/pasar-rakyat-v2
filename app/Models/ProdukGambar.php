<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukGambar extends Model
{

    use HasFactory;
    protected $fillable = ["gambar", "produk_id"];
}
