<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('taxes', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('tax_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('income_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('expense_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->foreign('emp_id')->references('id')->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('tax_id')->references('id')->on('taxes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('po_id')->references('id')->on('purchase_orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('emp_id')->references('id')->on('employees')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('car_models', function (Blueprint $table) {
            $table->foreign('brand_id')->references('id')->on('car_brands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('car_models')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('maintenances', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('maintenance_services', function (Blueprint $table) {
            $table->foreign('maintenance_id')->references('id')->on('maintenances')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('maintenances', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
       
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropForeign('areas_city_id_foreign');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('customers_city_id_foreign');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('customers_area_id_foreign');
        });

        Schema::table('taxes', function (Blueprint $table) {
            $table->dropForeign('taxes_type_id_foreign');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeign('incomes_type_id_foreign');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign('expenses_type_id_foreign');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign('expenses_user_id_foreign');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_job_id_foreign');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->dropForeign('salaries_emp_id_foreign');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropForeign('purchase_orders_supplier_id_foreign');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropForeign('purchase_orders_inventory_id_foreign');
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropForeign('sales_orders_customer_id_foreign');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_tax_id_foreign');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_user_id_foreign');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropForeign('purchase_orders_user_id_foreign');
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropForeign('sales_orders_user_id_foreign');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_user_id_foreign');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_po_id_foreign');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_user_id_foreign');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->dropForeign('salaries_user_id_foreign');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_category_id_foreign');
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_item_id_foreign');
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign('inventories_emp_id_foreign');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_category_id_foreign');
        });

        Schema::table('car_models', function (Blueprint $table) {
            $table->dropForeign('car_models_brand_id_foreign');
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_model_id_foreign');
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_customer_id_foreign');
        });
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_user_id_foreign');
        });

        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeign('maintenances_care_id_foreign');
        });

        Schema::table('maintenance_services', function (Blueprint $table) {
            $table->dropForeign('maintenance_services_maintenance_id_foreign');
        });
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropForeign('maintenances_user_id_foreign');
        });


        
    }
}
