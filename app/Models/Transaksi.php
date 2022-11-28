<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = ["total", "quantity", "user_id", "produk_id", "transaksi_total_id"];

    use HasFactory;
}
