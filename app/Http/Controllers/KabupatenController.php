<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::paginate(5);
        $provinsis = Provinsi::paginate(5);
        return view("pages.kabupaten.index", compact("kabupatens", "provinsis"));
    }
    public function edit(Request $request, Kabupaten $kabupaten)
    {
        $provinsis = Provinsi::paginate(5);
        return view("pages.kabupaten.edit", compact("kabupaten", "provinsis"));
    }
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $attr = $request->validate([
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "logo" => "nullable|mimes:png,jpg,jpeg",
            "lat" => "nullable",
            "lang" => "nullable",
            "provinsi_id" => "nullable|exists:provinsis,id",
        ]);
        if ($request->file("logo")) {
            Storage::delete($kabupaten->logo);
            $attr["logo"] = $request->file("logo")->store("/kabupaten/logo");
        }
        $kabupaten->update($attr);
        return redirect()->route("kabupaten-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "provinsi_id" => "nullable|exists:provinsis,id",
            "nama" => "required",
            "deskripsi" => "required",
            "logo" => "required|mimes:png,jpg,jpeg",
            "lat" => "required",
            "lang" => "required"
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/kabupaten/logo");
        Kabupaten::create($attr);
        return redirect()->route("kabupaten-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, Kabupaten $kabupaten)
    {
        $kabupaten->delete();
        return redirect()->route("kabupaten-index")->with("success", "berhasil menghapus data");
    }
}
