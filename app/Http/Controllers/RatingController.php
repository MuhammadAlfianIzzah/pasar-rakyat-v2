<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\RatingProduk;
use App\Models\TransaksiTotal;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Produk $produk)
    {
        $attr = $request->validate([
            "nama" => "required",
            "kode_transaksi" => "required",
            "komentar" => "required",
            "rating" => "required"
        ]);
        $kode_transaksi = $attr["kode_transaksi"];
        $attr["produk_id"] = $produk->id;
        $attr["transaksi_total_id"] = $kode_transaksi;
        $tt = TransaksiTotal::where("id", $kode_transaksi)->first()->rating;
        if ($tt !== null) {
            return back()->with("error", "kode transaksi sudah pernah dipakai");
        }
        RatingProduk::create($attr);
        return back()->with("success", "berhasil menambahkan komentar");
    }
}
