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
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->string("nomor_hp");
            $table->text("slug");
            $table->text("deskripsi");
            $table->text("alamat_lengkap");
            $table->string("logo");
            $table->string("lat");
            $table->string("lang");
            $table->boolean("is_core")->default(false);
            $table->foreignUuid("kabupaten_id");
            $table->foreign("kabupaten_id")->references("id")->on("kabupatens");
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
        Schema::dropIfExists('vendors');
    }
};
