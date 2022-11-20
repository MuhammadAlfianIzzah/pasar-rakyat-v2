<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $fillable = ["nama", "is_core", "logo", "lat", "lang", "deskripsi", "alamat_lengkap", "slug", "user_id", "kabupaten_id"];
}
