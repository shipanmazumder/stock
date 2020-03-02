<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('voucher_no')->unique();
            $table->string('picture');
            $table->integer('total_qty');
            $table->integer('store_by');
            $table->date('date');
            $table->string('remarks')->nullable();
            $table->index("store_by");
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->index("supplier_id");
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
        Schema::dropIfExists('stores');
    }
}
