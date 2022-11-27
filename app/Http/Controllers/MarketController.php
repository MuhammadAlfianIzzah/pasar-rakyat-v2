<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MarketController extends Controller
{
    public function index(Request $request, Vendor $vendor)
    {
        return  view("pages.admin.market.index", compact("vendor"));
    }
    public function edit(Request $request, Vendor $vendor)
    {
        $kabupatens = Kabupaten::get();
        return  view("pages.admin.market.edit", compact("vendor", "kabupatens"));
    }
    public function update(Request $request, Vendor $vendor)
    {
        $attr = $request->validate([
            "nama" => "nullable",
            "deskripsi" => "nullable",
            "alamat_lengkap" => "nullable",
            "kabupaten_id" => "nullable|exists:kabupatens,id",
            "logo" => "nullable",
            "lat" => "nullable",
            "lang" => "nullable"
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        if ($request->file("logo")) {
            Storage::delete($vendor->logo);
            $attr["logo"] = $request->file("logo")->store("/vendor/logo");
        }
        $attr["user_id"] = auth()->user()->id;
        $vendor->update($attr);
        return redirect()->route("market.index", [$vendor->slug])->with("success", "berhasil mendaftarkan Vendor");
    }
}
