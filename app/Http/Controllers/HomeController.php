<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\TransaksiTotal;
use App\Models\Vendor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $produk_terlaris =  Produk::get();
        $kategoris = KategoriProduk::get();
        $vendors = Vendor::get();
        $map_vendor = Vendor::where("is_core", true)->get();
        return view("pages.home.index", compact("produk_terlaris", "kategoris", "vendors", "map_vendor"));
    }
    public function detailProduk(Request $request, Produk $produk)
    {
        $harga = $produk->harga_max;
        if ($request->kupon == $produk->kupon) {
            $harga =  $request->harga >= $produk->harga_min ? $request->harga : $produk->harga_max;
        }
        return view("pages.home.detail-produk", compact("produk", "harga"));
    }
    public function detailVendor(Request $request, Vendor $vendor)
    {
        return view("pages.home.detail.vendor", compact("vendor"));
    }

    public function produk()
    {
        $produks = Produk::filter(request(["search", "kategori_id"]))->get();
        $kategoris = KategoriProduk::get();
        return view("pages.home.produk.index", compact("produks", "kategoris"));
    }
    public function vendor()
    {
        $vendors = Vendor::filter(request(["search"]))->get();
        return view("pages.home.vendor.index", compact("vendors"));
    }


    public function tawarProduk(Request $request, Produk $produk)
    {

        $attr =  $request->validate([
            "harga_tawar" => "required",
        ]);

        if ($attr["harga_tawar"] < $produk->harga_min) {
            session()->flash('error', 'tawaran ditolak, silahkan masukin penawaran lain');
            return route("home-detailProduk", [$produk->slug, "kupon" => $produk->kupon, "harga" => $attr["harga_tawar"]]);
        }
        session()->flash('error', 'tawaran berhasil');
        return route("home-detailProduk", [$produk->slug, "kupon" => $produk->kupon, "harga" => $attr["harga_tawar"]]);
    }

    public function claimTrasaksi()
    {
        $transaksi = TransaksiTotal::where("admin_id", auth()->user()->id)->get();
        return view("pages.admin.claim.trasaksi", compact("transaksi"));
    }
    public function claimTrasaksiStore(Request $request)
    {
        // dd("oke");
        $attr = $request->validate([
            "transaksi_total_id" => "required|exists:transaksi_totals,id"
        ]);

        $transaksi =  TransaksiTotal::where("id", $attr["transaksi_total_id"])->first();
        if ($transaksi->already_paid ===  null) {
            $transaksi->update([
                "already_paid" => now(),
                "admin_id" => auth()->user()->id
            ]);
            return back()->with("success", "transaksi  berhasil diclaim");
        }
        return back()->with("error", "transaksi sudah pernah diclaim");
    }

    public function getKategoris(Request $request)
    {
        $data = KategoriProduk::get();
        return response()->json($data);
    }
}
