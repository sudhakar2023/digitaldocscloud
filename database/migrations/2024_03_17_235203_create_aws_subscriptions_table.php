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
        Schema::create('aws_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->unsignedBigInteger('aws_customer_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamp('expiry_date');

            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
            $table->foreign('aws_customer_id')->references('id')->on('aws_customers')->onDelete('cascade');
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
        Schema::dropIfExists('aws_subscriptions');
    }
};
