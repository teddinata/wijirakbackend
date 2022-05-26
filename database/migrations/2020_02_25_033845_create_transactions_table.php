<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('users_id');

            $table->string('penerima')->nullable();
            $table->string('phone')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('shipping_notes')->nullable();
            $table->string('postcode')->nullable();

            $table->integer('quantity')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->string('status')->default('PENDING');

            // $table->integer('transaction_total');
            // $table->string('transaction_status');

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
        Schema::dropIfExists('transactions');
    }
}
