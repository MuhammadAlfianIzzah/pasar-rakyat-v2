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
        Schema::create('produks', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->text("slug");
            $table->text("deskripsi");
            $table->integer("harga_min");
            $table->integer("harga_max");
            $table->integer("stok");
            $table->foreignUuid("vendor_id")->nullable();
            $table->foreign("vendor_id")->references("id")->on("vendors");
            $table->foreignUuid("kategori_id");
            $table->foreign("kategori_id")->references("id")->on("kategori_produks");
            $table->string("kupon")->default("kuponku");
            $table->foreignUuid("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->softDeletes();
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
        Schema::dropIfExists('produks');
    }
};
