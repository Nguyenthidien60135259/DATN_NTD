<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }

    public function size(){
        return $this->belongsTo('App\Models\Size','size_id');
    }

    public function order(){
        return $this->belongsTo("App\Models\Order","order_id");
    }
    public function getAll(){
        $result = DB::table('order_details')->get();
        return $result;
    }
    public function getOrderDetailById($id){
        $result = DB::table('order_details')
        ->where('order_id',$id)->first();
        return $result;
    }
    public function getProductOder($id){
        $product_order = OrderDetail::with("product")->where('order_id',$id)->get();
        // $product_order = DB::table('order_details')
        // ->join()
        return $product_order;
    }
    // public function getOrderDetailBy
}
