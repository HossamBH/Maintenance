<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    //cities
    Route::resource('cities', 'CitiesController');
    //areas
    Route::resource('areas', 'AreasController');
    //types of taxes
    Route::resource('taxTypes', 'TaxTypesController');
    //taxes
    Route::resource('taxes', 'TaxesController');
    //categories for items
    Route::resource('categories', 'CategoriesController');
    //items
    Route::resource('items', 'ItemsController');
    //customers
    Route::resource('customers', 'CustomersController');
    /*get areas of cities ajax */
    Route::get('get_areas/{city}', 'CustomersController@getAreas')->name('getAreas');
    //jobs for employees
    Route::resource('jobs', 'Jobscontroller');
    //salaries for employees
    Route::resource('salaries', 'SalariesController');
    //employees
    Route::resource('employees', 'Employeescontroller');
    //inventories
    Route::resource('inventories', 'InventoriesController');
    //suppliers
    Route::resource('suppliers', 'SuppliersController');
    //purchase orders
    Route::resource('purchaseOrders', 'PurchaseOrdersController');
    //offers
    Route::resource('offers', 'OffersController');
    //users
    Route::resource('users', 'UsersController');
    //roles
    Route::resource('roles', 'RolesController');
    //payments
    Route::resource('payments', 'PaymentsController');
    /*get Items by category_id */
    Route::get('getItemsByCategory/{category}', 'AjaxController@getItemsByCategory')->name('getItems');
    Route::get('getItem/{item}/{quantity}/{invoice}', 'AjaxController@getItem')->name('getSales');
    Route::get('getService/{service}/{invoice}', 'AjaxController@getService')->name('getService');
    Route::get('totalMaintenance/{itemSub}/{serviceSub}', 'AjaxController@totalMaintenance')->name('totalMaintenance');

    Route::get('total/{cost}/{quantity}/{invoice}', 'AjaxController@TotalPurchaseOrder')->name('getPurchase');
    Route::get('remaining/{paid}/{total}', 'AjaxController@remaining')->name('getRemaining');
    //sales Order
    Route::resource('salesOrders', 'SalesOrderController');
    //invoices for sales order
    Route::resource('invoices', 'InvoicesController');
    //Types of expenses
    Route::resource('expensesType', 'ExpenseTypeController');
    //expenses
    Route::resource('expenses', 'ExpensesController');
    //profits

    Route::get('reports/profits', 'ReportsController@profits')->name('profits');

    
    //safes
    Route::get('report/safes', 'ReportsController@safe')->name('report.safe');

    //services
    Route::resource('services', 'ServicesController');
    //car brands
    Route::resource('carBrands', 'CarBrandsController');
     //car models
     Route::resource('carModels', 'CarModelsController');
     //cars
     Route::get('cars/insert/{customer_id}','CarsController@insert');
     Route::resource('cars', 'CarsController');
    //get models of slected brand
    Route::get('get_Models/{brand_id}', 'AjaxController@getModelsByBrand')->name('getBrands');
    //get customer cars
    Route::get('customerCars/{customer_id}', 'AjaxController@customerCars')->name('getCars');

    
    //car maintenance
    Route::resource('serviceMaintenance', 'ServiceMaintenanceController');


 
});
