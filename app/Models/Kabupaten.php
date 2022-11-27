<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kabupaten extends Model
{
    protected $fillable = ["nama", "logo", "lat", "lang", "deskripsi", "slug", "provinsi_id"];
    use HasFactory, HasUuids, SoftDeletes;

    public function adminPasarKabupaten()
    {
        return $this->hasOne(AdminPasarKabupaten::class, "kabupaten_id");
    }
}
