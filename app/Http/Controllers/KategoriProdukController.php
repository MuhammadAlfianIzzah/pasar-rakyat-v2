<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategori_produks = KategoriProduk::paginate(5);
        return view("pages.kategori_produk.index", compact("kategori_produks"));
    }
    public function edit(Request $request, KategoriProduk $kategori_produk)
    {
        return view("pages.kategori_produk.edit", compact("kategori_produk"));
    }
    public function update(Request $request, KategoriProduk $kategori_produk)
    {
        $attr = $request->validate([
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "logo" => "nullable|mimes:png,jpg,jpeg",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        if ($request->file("logo")) {
            Storage::delete($kategori_produk->logo);
            $attr["logo"] = $request->file("logo")->store("/kategori/produk/logo");
        }
        $kategori_produk->update($attr);
        return redirect()->route("kategori-produk-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "deskripsi" => "required",
            "logo" => "required|mimes:png,jpg,jpeg",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/kategori/produk/logo");
        KategoriProduk::create($attr);
        return redirect()->route("kategori-produk-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, KategoriProduk $kategori_produk)
    {
        $kategori_produk->delete();
        return redirect()->route("kategori-produk-index")->with("success", "berhasil menghapus data");
    }
}
