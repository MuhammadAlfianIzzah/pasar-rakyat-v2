<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiTotal extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ["nama", "user_id", "nomor_hp", "alamat", "kota", "kecamatan", "total", "quantity", "already_paid", "admin_id"];
    use HasFactory, HasUuids, SoftDeletes;
    public function rating()
    {
        return $this->hasOne(RatingProduk::class, "transaksi_total_id");
    }
}
