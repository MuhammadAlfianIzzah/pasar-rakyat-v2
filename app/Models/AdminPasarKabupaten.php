<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPasarKabupaten extends Model
{
    protected $fillable = ["nama", "nomor_hp", "user_id", "kabupaten_id", "slug"];
    use HasFactory, HasUuids, SoftDeletes;
}
