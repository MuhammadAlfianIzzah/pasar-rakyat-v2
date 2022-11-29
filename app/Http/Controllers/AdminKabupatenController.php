<?php

namespace App\Http\Controllers;

use App\Models\AdminPasarKabupaten;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKabupatenController extends Controller
{
    public function index()
    {
        $adminKabupatens = AdminPasarKabupaten::paginate(5);
        $kabupatens = Kabupaten::get();
        $users = User::where("user_group_id", 1)->get();
        return view("pages.admin.admin_kabupaten.index", compact("adminKabupatens", "kabupatens", "users"));
    }
    public function edit(Request $request, AdminPasarKabupaten $adminKabupaten)
    {
        $kabupatens = Kabupaten::get();
        $users = User::where("user_group_id", 1)->get();
        return view("pages.admin.admin_kabupaten.edit", compact("adminKabupaten", "kabupatens", "users"));
    }
    public function update(Request $request, AdminPasarKabupaten $adminKabupaten)
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
            Storage::delete($adminKabupaten->logo);
            $attr["logo"] = $request->file("logo")->store("/vendor/logo");
        }
        $adminKabupaten->update($attr);
        return redirect()->route("admin-kabupaten-index")->with("success", "berhasil mengupdate data");
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "nomor_hp" => "nullable",
            "kabupaten_id" => "required|exists:kabupatens,id",
            "user_id" => "required|exists:users,id",
        ]);
        $attr["slug"] = Str::slug($attr["nama"] . "-" . uniqid(), '-');
        AdminPasarKabupaten::create($attr);
        return redirect()->route("admin-kabupaten-index")->with("success", "berhasil menambahkan data");
    }
    public function destroy(Request $request, AdminPasarKabupaten $adminKabupaten)
    {
        $adminKabupaten->delete();
        return redirect()->route("admin-kabupaten-index")->with("success", "berhasil menghapus data");
    }
}
