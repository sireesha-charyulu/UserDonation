<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('charity_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('billing_id');
            $table->decimal('amount',9,3);
            $table->timestamps();

            $table->foreign('charity_id')
                ->references('id')
                ->on('charities');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('billing_id')
                ->references('id')
                ->on('billings');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
