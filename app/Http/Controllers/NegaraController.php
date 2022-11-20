<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NegaraController extends Controller
{
    public function index()
    {
        $negaras = Negara::paginate(5);
        return view("pages.negara.index", compact("negaras"));
    }
    public function edit(Request $request, Negara $negara)
    {
        return view("pages.negara.edit", compact("negara"));
    }
    public function update(Request $request, Negara $negara)
    {
        $attr = $request->validate([
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "logo" => "nullable|mimes:png,jpg,jpeg",
            "lat" => "nullable",
            "lang" => "nullable"
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        if ($request->file("logo")) {
            Storage::delete($negara->logo);
            $attr["logo"] = $request->file("logo")->store("/negara/logo");
        }
        $negara->update($attr);
        return redirect()->route("negara-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "deskripsi" => "required",
            "logo" => "required|mimes:png,jpg,jpeg",
            "lat" => "required",
            "lang" => "required"
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/negara/logo");
        Negara::create($attr);
        return redirect()->route("negara-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, Negara $negara)
    {
        $negara->delete();
        return redirect()->route("negara-index")->with("success", "berhasil menghapus data");
    }
}
