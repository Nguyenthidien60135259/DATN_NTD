<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductSize extends Model
{
    use HasFactory;
    
    public function getSizeByProductId($key){
        $result = DB::table('product_sizes')
        ->join('sizes as size','product_sizes.size_id','=','size.id')
        ->where('product_id', '=', $key)->get();
        return $result;
    }
    public function getProductNew($key){
        $result = DB::table('product_sizes')
        ->join('sizes as size','product_sizes.size_id','=','size.id')
        ->leftjoin('products as product','product_sizes.product_id','=','product.id')
        ->where('product_id', '=', $key);
        // ->orderBy('created_at', 'desc')->get();
        // ->orderBy('sale', 'desc')->get();
        return $result;
    }
    public function getProductExpensive($key){
        $result = DB::table('product_sizes')
        ->join('sizes as size','product_sizes.size_id','=','size.id')
        ->leftjoin('products as product','product_sizes.product_id','=','product.id')
        ->where('product_id', '=', $key)
        ->orderBy('sale', 'desc')->get();
        return $result;
    }
    public function getProductCheap($key){
        $result = DB::table('product_sizes')
        ->join('sizes as size','product_sizes.size_id','=','size.id')
        ->leftjoin('products as product','product_sizes.product_id','=','product.id')
        ->where('product_id', '=', $key)
        ->orderBy('sale', 'asc')->get();
        return $result;
    }
    public function updateProductSize($id,$pro_id,$data){
        DB::table('product_sizes')->where('size_id','=',$id)->where('product_id',$pro_id)->update($data);
    }

    public function getProductSize($pro,$size){
        $result = DB::table('product_sizes')->where('size_id','=',$size)->where('product_id',$pro)->get();
        return $result;
    }
    public function addProductSize($data)
    {
        DB::table('product_sizes')->insert($data);
    }
}
