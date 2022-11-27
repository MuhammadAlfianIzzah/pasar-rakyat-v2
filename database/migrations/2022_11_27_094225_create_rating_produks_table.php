<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid("produk_id");
            $table->foreign("produk_id")->references("id")->on("produks");
            $table->foreignUuid("transaksi_total_id");
            $table->foreign("transaksi_total_id")->references("id")->on("transaksi_totals");
            $table->foreignUuid("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->text("komentar");
            $table->integer("rating");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating_produks');
    }
};
