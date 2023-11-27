<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCoupionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_coupions', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->decimal('discount', 8, 2);
            $table->date('start_date')->nullable();
            $table->date('expiration_date');
            $table->boolean('is_active')->default(true);
            $table->integer('max_uses')->nullable();
            $table->integer('uses')->default(0);
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
        Schema::dropIfExists('discount_coupions');
    }
}
