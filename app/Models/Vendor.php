<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = ["nama", "nomor_hp", "is_core", "logo", "lat", "lang", "deskripsi", "alamat_lengkap", "slug", "user_id", "kabupaten_id"];
    public function produks()
    {
        return $this->hasMany(Produk::class, "vendor_id");
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, "kabupaten_id");
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        });
    }
}
