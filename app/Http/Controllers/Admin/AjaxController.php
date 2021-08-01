<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Item;
use App\Models\Service;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //return items of selcted category
    public function getItemsByCategory($category_id){
        $items = Item::where('category_id', '=', $category_id)->select('*')->get()->toArray();
        return response()->json($items);
    }



//return item details and the subtotall for item ,subtotal and Total for all items in create sales order
    public function getItem(Request $request,$item_id,$quantity,$invoice){
        
        //dd($total);
        //dd($quantity);
        $subAllTotal=0;
        $alltax=0;
        $total=0;
        $invoiceData=json_decode($invoice);

        foreach ($invoiceData as $key => $value) {
            $item = Item::Find($value[0]);
            $subAllTotal+=$item->price*$value[1];
            $alltax+=$value[1]*$item->category->tax->percentage*$item->price/100;  
        }
        $total=$subAllTotal+$alltax;
        //dd($total);
        //dd(json_decode($invoice));
        $item = Item::FindOrFail($item_id);
        $subtotal=$item->price*1;  
        if($quantity){
          
            $subtotal=$item->price*$quantity; 
        }
        $data['item']=$item;
        $data['subtotal']=$subtotal;
        $data['subAllTotal']=$subAllTotal;
        $data['allTax']=$alltax;
        $data['total']=$total;


        return response()->json($data);
    }

//return service details and the subtotall for item ,subtotal and Total for all items in create service maintenance
public function getService(Request $request,$service_id,$invoice){
        
    //dd($total);
    //dd($quantity);
    $subAllTotal=0;
    $alltax=0;
    $total=0;
    $invoiceData=json_decode($invoice);

    foreach ($invoiceData as $key => $value) {
        $service = Service::where('id',$value)->first();
        //dd($service->cost);
        //dd((int)$value);
        $subAllTotal+=$service->cost;
        $alltax+=$service->tax*$service->cost/100;  
    }
    $total=$subAllTotal+$alltax;
    //dd($total);
    //dd(json_decode($invoice));
    $service = Service::FindOrFail($service_id);
    $subtotal=$service->cost*1;  
    $data['service']=$service;
    $data['subtotal']=$subtotal;
    $data['subAllTotal']=$subAllTotal;
    $data['allTax']=$alltax;
    $data['total']=$total;


    return response()->json($data);
}


    //return total amount for all items in create purchase order
    
    public function TotalPurchaseOrder(Request $request,$cost,$quantity,$invoice){
        $subAllTotal=0;
        $total=0;
        $invoiceData=json_decode($invoice);

        foreach ($invoiceData as $key => $value) {
            $subAllTotal+=$value[0]*$value[1]; 
        }
        $total=$subAllTotal;
       
        $subtotal=$cost*1;  
        if($quantity){
          
            $subtotal=$cost*$quantity; 
        }
        $data['subtotal']=$subtotal;
        $data['subAllTotal']=$subAllTotal;
        $data['total']=$total;


        return response()->json($data);
    }

    //return the remaining amount of paid in purchase order 

    public function remaining(Request $request,$paid,$total){
        $remaining=$total-$paid;
        $data['remaining']=$remaining;
        return response()->json($data);

    }


    //return models of selected car brand
    public function getModelsByBrand($brand_id){
        $carModels = CarModel::where('brand_id', '=', $brand_id)->select('*')->get()->toArray();
        //dd($carModels);
        return response()->json($carModels);
    }

    //return cars of selected customer
    public function customerCars($customer_id){
        $cars = Car::join('car_models','cars.model_id','=','car_models.id')
        ->where('cars.customer_id', '=', $customer_id)->
        select('cars.*','car_models.name as name')->get()->toArray();
        return response()->json($cars);
    }
public function totalMaintenance(Request $request,$itemSubtotal,$serviceSubtotal){
    

}
    
 public function invoice(Request $request,$invoice){
   $total=json_encode($invoice);
   dd($total);

        return response()->json($data);
    }

    
}
