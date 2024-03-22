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
        Schema::create('billing_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->references('id')->on('subscriptions')->onDelete('CASCADE');
            $table->string('product_id')->unique();
            $table->string('price_id')->nullable();
            $table->enum('provider', ['stripe', 'paypal']);
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
        Schema::dropIfExists('billing_products');
    }
};
