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
        Schema::create('provinsis', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->string("logo");
            $table->text("slug");
            $table->text("deskripsi");
            $table->string("lat");
            $table->string("lang");
            $table->softDeletes();
            $table->foreignUuid("negara_id");
            $table->foreign("negara_id")->references("id")->on("negaras");
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
        Schema::dropIfExists('provinsis');
    }
};
