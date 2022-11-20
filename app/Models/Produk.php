<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = ["nama", "deskripsi", "slug", "harga_min", "harga_max", "stok", "vendor_id", "kategori_id", "user_id"];

    public function logos()
    {
        return $this->hasMany(ProdukGambar::class, "produk_id");
    }
}
