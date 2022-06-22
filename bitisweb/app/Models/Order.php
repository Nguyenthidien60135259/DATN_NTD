<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Function_;

class Order extends Model
{
    use HasFactory;
    public function getOrderById($id){
        $result = DB::table('orders')
        ->join('customers as customer','orders.customer_id','=','customer.id')
        ->join('shippings as shipping','orders.shipping_id','=','shipping.id')
        ->join('order_details as order_detail','orders.id','=','order_detail.order_id')
        ->join('sizes as size','size.id','order_detail.size_id')
        ->select('orders.*','shipping.*','order_detail.*','customer.*','size.*')->where('orders.id','=',$id)->first();
        return $result;
    }

    public function getAllOrder(){
        $all_order = DB::table('orders')
        ->join('customers as customer','orders.customer_id','=','customer.id')
        ->select('orders.*','customer.name')
        ->orderBy('orders.id','desc')->get();
        return $all_order;
    }
    
}
