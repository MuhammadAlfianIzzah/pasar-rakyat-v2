<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produk_terlaris =  Produk::get();
        return view("pages.home.index", compact("produk_terlaris"));
    }
    public function detailProduk(Request $request, Produk $produk)
    {
        return view("pages.home.detail-produk", compact("produk"));
    }
}
