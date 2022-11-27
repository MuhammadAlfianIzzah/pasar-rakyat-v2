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
        Schema::create('transaksi_totals', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->string("nomor_hp");
            $table->text("alamat");
            $table->string("kota");
            $table->string("kecamatan");
            $table->integer("total");
            $table->integer("quantity");
            $table->timestamp("already_paid")->nullable();
            $table->foreignUuid("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreignUuid("admin_id")->nullable();
            $table->foreign("admin_id")->references("id")->on("users");
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
        Schema::dropIfExists('transaksi_totals');
    }
};
