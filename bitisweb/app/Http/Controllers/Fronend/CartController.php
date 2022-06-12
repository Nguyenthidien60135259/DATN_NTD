<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function save_cart(Request $request){
        $response = Http::get("http://127.0.0.1:8001/api/detail/".$request->product_id);
        $data = json_decode($response);
        $product = $data->data->product;
        $qty = $request->qty;
        $price = $request->pro_price;
        $size=$request->product_size;
        return view('client.cart');
    }
}
