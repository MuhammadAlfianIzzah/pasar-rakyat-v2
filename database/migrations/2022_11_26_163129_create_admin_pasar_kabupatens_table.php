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
        Schema::create('admin_pasar_kabupatens', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nama");
            $table->text("slug");
            $table->string("nomor_hp");
            $table->foreignUuid("kabupaten_id");
            $table->foreign("kabupaten_id")->references("id")->on("kabupatens");
            $table->foreignUuid("user_id")->nullable();
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
        Schema::dropIfExists('admin_pasar_kabupatens');
    }
};
