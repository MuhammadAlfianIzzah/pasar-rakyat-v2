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
        Schema::create('kabupatens', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->text("slug");
            $table->text("deskripsi");
            $table->string("logo");
            $table->string("lat");
            $table->string("lang");
            $table->softDeletes();
            $table->foreignUuid("provinsi_id");
            $table->foreign("provinsi_id")->references("id")->on("provinsis");
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
        Schema::dropIfExists('kabupatens');
    }
};
