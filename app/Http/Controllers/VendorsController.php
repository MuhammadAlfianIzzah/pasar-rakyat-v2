<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorsController extends Controller
{
    public function index()
    {
        $vendors = Vendor::paginate(5);
        $kabupatens = Kabupaten::get();
        $users = User::get();
        return view("pages.vendor.index", compact("vendors", "kabupatens", "users"));
    }
    public function edit(Request $request, Vendor $vendor)
    {
        $kabupatens = Kabupaten::get();
        $users = User::get();
        return view("pages.vendor.edit", compact("vendor", "kabupatens", "users"));
    }
    public function update(Request $request, Vendor $vendor)
    {
        $attr = $request->validate([
            "is_core" => "nullable",
            "nama" => "nullable",
            "nomor_hp" => "nullable",
            "deskripsi" => "nullable",
            "alamat_lengkap" => "nullable",
            "logo" => "nullable|mimes:png,jpg,jpeg,webp",
            "lat" => "nullable",
            "lang" => "nullable",
            "kabupaten_id" => "nullable|exists:kabupatens,id",
            "user_id" => "nullable|exists:users,id",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        isset($attr["is_core"]) ?  $attr["is_core"] = true : $attr["is_core"] = false;
        if ($request->file("logo")) {
            Storage::delete($vendor->logo);
            $attr["logo"] = $request->file("logo")->store("/vendor/logo");
        }
        $vendor->update($attr);
        return redirect()->route("vendor-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "is_core" => "nullable",
            "nama" => "required",
            "nomor_hp" => "nullable",
            "deskripsi" => "required",
            "alamat_lengkap" => "required",
            "logo" => "required|mimes:png,jpg,jpeg,webp",
            "lat" => "required",
            "lang" => "required",
            "kabupaten_id" => "required|exists:kabupatens,id",
            "user_id" => "required|exists:users,id",
        ]);
        isset($attr["is_core"]) ?  $attr["is_core"] = true : $attr["is_core"] = false;
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/vendor/logo");
        Vendor::create($attr);
        return redirect()->route("vendor-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route("vendor-index")->with("success", "berhasil menghapus data");
    }
}
