<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('trans_id');
            $table->decimal('total_amount', 10, 2);
            $table->unsignedBigInteger('type_id');
            $table->longText('comments');
            $table->enum('payment_type', ['cash', 'visa']);
            $table->unsignedBigInteger('user_id');
            $table->string('file_attachment');
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
        Schema::dropIfExists('expenses');
    }
}
