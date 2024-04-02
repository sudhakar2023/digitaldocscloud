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
        Schema::create('aws_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->unsignedBigInteger('aws_customer_id');
            $table->string('dimension');
            $table->unsignedInteger('usage');
            $table->timestamps();

            $table->foreign('subscription_id')->on('subscriptions')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('aws_customer_id')->on('aws_customers')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aws_usages');
    }
};
