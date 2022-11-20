<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsis = Provinsi::paginate(5);
        $negaras = Negara::get();
        return view("pages.provinsi.index", compact("provinsis", "negaras"));
    }
    public function edit(Request $request, Provinsi $provinsi)
    {
        $negaras = Negara::get();
        return view("pages.provinsi.edit", compact("negaras", "provinsi"));
    }
    public function update(Request $request, Provinsi $provinsi)
    {
        $attr = $request->validate([
            "negara_id" => "nullable|exists:negaras,id",
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "logo" => "nullable|mimes:png,jpg,jpeg",
            "lat" => "nullable",
            "lang" => "nullable"
        ]);
        if ($request->file("logo")) {
            Storage::delete($provinsi->logo);
            $attr["logo"] = $request->file("logo")->store("/provinsi/logo");
        }
        $provinsi->update($attr);
        return redirect()->route("provinsi-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "negara_id" => "required|exists:negaras,id",
            "deskripsi" => "required",
            "logo" => "required|mimes:png,jpg,jpeg",
            "lat" => "required",
            "lang" => "required"
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/provinsi/logo");

        Provinsi::create($attr);
        return redirect()->route("provinsi-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, Provinsi $provinsi)
    {
        $provinsi->delete();
        return redirect()->route("provinsi-index")->with("success", "berhasil menghapus data");
    }
}
