<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('transactionHeaderId');
            $table->foreign('transactionHeaderId')->references('id')->on('transaction_headers')->onDelete('cascade');;
            $table->unsignedInteger('productId');
            $table->foreign('productId')->references('id')->on('products');
            $table->integer('quantity');
            $table->integer('subTotal');
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
        Schema::dropIfExists('transaction_details');
    }
}
