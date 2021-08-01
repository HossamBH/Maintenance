<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10, 2);
            $table->bigInteger('entity_id');
            $table->enum('payment_type', ['cash', 'visa']);
            $table->enum('status', ['in', 'out']);
            $table->enum('type', ['sales_order', 'purchase_order', 'salary', 'expense', 'payment','maintenance']);
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
        Schema::dropIfExists('reports');
    }
}
