<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userId');
            $table->string('currencyFrom', 3);
            $table->string('currencyTo', 3);
            $table->decimal('amountSell', 50, 2);
            $table->decimal('amountBuy', 50, 2);
            $table->decimal('rate', 5, 4);
            $table->timestamp('timePlaced');
            $table->string('originatingCountry', 2);
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
        Schema::dropIfExists('exchanges');
    }
}
