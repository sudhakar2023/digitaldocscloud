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
        Schema::create('billing_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->enum('type', ['paypal', 'stripe']);
            $table->string('transaction_id');
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_transactions');
    }
};
