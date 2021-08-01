<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->date('expected_on');
            $table->unsignedBigInteger('inventory_id');
            $table->longText('comments');
            $table->decimal('paid', 10, 2);
            $table->decimal('remaining', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_type', ['cash', 'visa']);
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
        Schema::dropIfExists('purchase_orders');
    }
}
