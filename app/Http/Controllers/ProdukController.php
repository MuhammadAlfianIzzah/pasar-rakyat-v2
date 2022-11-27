<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\ProdukGambar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::where(["user_id" => auth()->user()->id])->paginate(5);
        $kategoris = KategoriProduk::get();
        return view("pages.produk.index", compact("produks", "kategoris"));
    }
    public function edit(Request $request, Produk $produk)
    {
        $kategoris = KategoriProduk::get();
        return view("pages.produk.edit", compact("produk", "kategoris"));
    }
    public function update(Request $request, Produk $produk)
    {
        $attr = $request->validate([
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "logo" => "nullable",
            "logo.*" => "mimes:png,jpg,jpeg,webp|image",
            "harga_min" => "nullable",
            "stok" => "nullable",
            "harga_max" => "nullable",
            "kategori_id" => "nullable|exists:kategori_produks,id",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        if ($request->file("logo")) {
            Storage::delete($produk->logo);
            $attr["logo"] = $request->file("logo")->store("/produk/logo");
        }
        $produk->update($attr);
        return redirect()->route("produk-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "deskripsi" => "required",
            "logo" => "required",
            "logo.*" => "mimes:png,jpg,jpeg,webp|image",
            "harga_min" => "required",
            "stok" => "required",
            "harga_max" => "required",
            "kategori_id" => "required|exists:kategori_produks,id",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["user_id"] = auth()->user()->id;
        $attr["vendor_id"] = auth()->user()->vendor[0]->id ?? null;
        $produk = Produk::create($attr);
        foreach ($request->file("logo") as $logo) {
            $nama_gambar = $logo->store("/produk/logo");
            ProdukGambar::create([
                "gambar" => $nama_gambar,
                "produk_id" => $produk->id
            ]);
        }
        return redirect()->route("produk-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, Produk $produk)
    {
        $produk->delete();
        return redirect()->route("produk-index")->with("success", "berhasil menghapus data");
    }
}
