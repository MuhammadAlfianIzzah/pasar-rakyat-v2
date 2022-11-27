<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MakeMarketController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::get();
        if (auth()->user()->vendor->count() > 0) {
            return redirect()->route("market.index", [auth()->user()->vendor[0]->slug]);
        }
        return view("pages.market.daftar", compact("kabupatens"));
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "nomor_hp" => "required",
            "deskripsi" => "required",
            "alamat_lengkap" => "required",
            "kabupaten_id" => "required|exists:kabupatens,id",
            "logo" => "required",
            "lat" => "required",
            "lang" => "required"
        ]);
        $user_id = Auth::user()->id;

        $user = User::where("id", $user_id)->first();
        $user->update([
            "user_group_id" => 2
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        $attr["logo"] = $request->file("logo")->store("/vendor/logo");
        $attr["user_id"] = auth()->user()->id;


        Vendor::create($attr);
        return redirect()->route("daftar-vendor-index")->with("success", "berhasil mendaftarkan Vendor");
    }
}
