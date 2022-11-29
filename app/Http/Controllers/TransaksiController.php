<?php

namespace App\Http\Controllers;

use App\Models\AdminPasarKabupaten;
use App\Models\Kabupaten;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiTotal;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $attr = $request->validate([
            "nama" => "required",
            "alamat" => "required",
            "kota" => "required",
            "kecamatan" => "required",
            "nomor_hp" => "required",
        ]);
        $attr["total"] = CartFacade::getTotal();
        $attr["quantity"] = CartFacade::getTotalQuantity();
        $attr["user_id"]  = auth()->user()->id ?? null;
        $trasaksi_id = TransaksiTotal::create($attr)->id;
        $cartItems = CartFacade::getContent();
        $textProduk = "";

        foreach ($cartItems as $item) {
            $produk = Produk::where(["id" => $item->id])->first();
            $nomor_hp = $produk->vendor->kabupaten->adminPasarKabupaten->nomor_hp ?? "89616452029";

            $url = route("home-detailProduk", [$produk->slug]);
            $textProduk .= "\n*$item->name (" . $produk->berat * $item->quantity . ") kg* \n" . $url . "\n$item->quantity x Rp.$item->price ( *Rp." . ($item->quantity * $item->price) . "* )\n__\n
                ";
            Transaksi::create(
                [
                    "produk_id" => $item->id,
                    "total" => $item->price,
                    "quantity" => $item->quantity,
                    "transaksi_total_id" => $trasaksi_id,
                    "user_id" => auth()->user()->id ?? null
                ]
            );
        }
        $text = "Halo Admin, saya " . $attr["nama"] . " mau pesan:\n\n— — — — — — — — — — —" . $textProduk . "\n— — — — — — — — — — —\nTotal : *Rp." . CartFacade::getTotal() . "*\n\n— — — — — — — — — — —\n*Atas nama :*\n" . $attr["nama"] . " \n*Nomor hp :*" . $attr["nomor_hp"] . "\n-\n*Alamat :*\n" . $attr["alamat"] . " - Kec. " . $attr["kecamatan"] . "\ndengan kode transaksi
        \n" . $trasaksi_id;
        $url = "https://wa.me/62" . $nomor_hp . "?text=" . urlencode($text);
        CartFacade::clear();
        return redirect()->away($url);
    }

    public function history()
    {
        $transaksi =  TransaksiTotal::where("user_id", auth()->user()->id)->paginate(10);
        return view("pages.admin.history.transaksi.index", compact("transaksi"));
    }
}
