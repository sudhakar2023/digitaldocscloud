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
        Schema::create('billing_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('provider', ['paypal', 'stripe']);
            $table->unsignedBigInteger('subscription_id');
            $table->string('billing_sub_id')->unique();
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_subscriptions');
    }
};
