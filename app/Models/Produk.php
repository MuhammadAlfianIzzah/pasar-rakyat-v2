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
    protected $fillable = ["nama", "deskripsi", "slug", "berat", "harga_min", "harga_max", "stok", "vendor_id", "kategori_id", "user_id", "kupon"];

    public function logos()
    {
        return $this->hasMany(ProdukGambar::class, "produk_id");
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, "vendor_id");
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, "produk_id");
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['kategori_id'] ?? false, function ($query, $kategori_id) {
            return $query->where(function ($query) use ($kategori_id) {
                $query->where('kategori_id', 'like', '%' . $kategori_id . '%');
            });
        });
    }
    public function ratings()
    {
        return $this->hasMany(RatingProduk::class, "produk_id");
    }
}
