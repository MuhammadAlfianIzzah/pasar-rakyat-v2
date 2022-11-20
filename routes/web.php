<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\NegaraController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\VendorsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, "index"])->name("home");
Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard")->middleware(['auth']);
Route::get("/produk/{produk:slug}", [HomeController::class, "detailProduk"])->name("home-detailProduk");

Route::prefix('setting')->middleware(["auth"])->group(function () {
    Route::get("/negara", [NegaraController::class, "index"])->name("negara-index");
    Route::post("/negara", [NegaraController::class, "store"])->name("negara-store");
    Route::delete("/negara/{negara:slug}", [NegaraController::class, "destroy"])->name("negara-destroy");
    Route::get("/negara/edit/{negara:slug}", [NegaraController::class, "edit"])->name("negara-edit");
    Route::put("/negara/{negara:slug}", [NegaraController::class, "update"])->name("negara-update");

    Route::get("/provinsi", [ProvinsiController::class, "index"])->name("provinsi-index");
    Route::post("/provinsi", [ProvinsiController::class, "store"])->name("provinsi-store");
    Route::delete("/provinsi/{provinsi:slug}", [ProvinsiController::class, "destroy"])->name("provinsi-destroy");
    Route::get("/provinsi/edit/{provinsi:slug}", [ProvinsiController::class, "edit"])->name("provinsi-edit");
    Route::put("/provinsi/{provinsi:slug}", [ProvinsiController::class, "update"])->name("provinsi-update");


    Route::get("/kabupaten", [KabupatenController::class, "index"])->name("kabupaten-index");
    Route::post("/kabupaten", [KabupatenController::class, "store"])->name("kabupaten-store");
    Route::delete("/kabupaten/{kabupaten:slug}", [KabupatenController::class, "destroy"])->name("kabupaten-destroy");
    Route::get("/kabupaten/edit/{kabupaten:slug}", [KabupatenController::class, "edit"])->name("kabupaten-edit");
    Route::put("/kabupaten/{kabupaten:slug}", [KabupatenController::class, "update"])->name("kabupaten-update");


    Route::get("/vendor", [VendorsController::class, "index"])->name("vendor-index");
    Route::post("/vendor", [VendorsController::class, "store"])->name("vendor-store");
    Route::delete("/vendor/{vendor:slug}", [VendorsController::class, "destroy"])->name("vendor-destroy");
    Route::get("/vendor/edit/{vendor:slug}", [VendorsController::class, "edit"])->name("vendor-edit");
    Route::put("/vendor/{vendor:slug}", [VendorsController::class, "update"])->name("vendor-update");


    Route::get("/kategori-produk", [KategoriProdukController::class, "index"])->name("kategori-produk-index");
    Route::post("/kategori-produk", [KategoriProdukController::class, "store"])->name("kategori-produk-store");
    Route::delete("/kategori-produk/{kategori_produk:slug}", [KategoriProdukController::class, "destroy"])->name("kategori-produk-destroy");
    Route::get("/kategori-produk/edit/{kategori_produk:slug}", [KategoriProdukController::class, "edit"])->name("kategori-produk-edit");
    Route::put("/kategori-produk/{kategori_produk:slug}", [KategoriProdukController::class, "update"])->name("kategori-produk-update");


    Route::get("/produk", [ProdukController::class, "index"])->name("produk-index");
    Route::post("/produk", [ProdukController::class, "store"])->name("produk-store");
    Route::delete("/produk/{produk:slug}", [ProdukController::class, "destroy"])->name("produk-destroy");
    Route::get("/produk/edit/{produk:slug}", [ProdukController::class, "edit"])->name("produk-edit");
    Route::put("/produk/{produk:slug}", [ProdukController::class, "update"])->name("produk-update");
});

require __DIR__ . '/auth.php';
