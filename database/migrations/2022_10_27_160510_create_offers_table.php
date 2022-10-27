<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->float('precio')->default(0);
            $table->string('mensaje')->nullable();
            $table->date('accepted_at')->nullable();
            $table->date('rejected_at')->nullable();
            $table->date('vigencia')->nullable();
            $table->unsignedBigInteger('ad_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('ad_id')->references('id')->on('ads');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function(Blueprint $table) {
            $table->dropForeign('offers_ad_id_foreign');
            $table->dropForeign('offers_user_id_foreign');
        });
        Schema::dropIfExists('offers');
    }
}
