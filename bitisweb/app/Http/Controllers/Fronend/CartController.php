<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id = $request->product_id;
        $response = Http::get("http://127.0.0.1:8001/api/detail/".$product_id);
        $data = json_decode($response);
        $product = $data->data->product;
        $qty = $request->qty;
        $price = $request->pro_price;
        $size=$request->product_size;
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $cart['id'] = $product_id;
        $cart['qty'] = $qty;
        $cart['price'] = $price;
        // $cart['size'] = $size;
        $cart['name'] = $product->name;
        $cart['options']['image'] = $product->product_image[0]->image;
        $cart['options']['size'] = $size;
        $cart['weight'] = $size;
        Cart::setGlobalTax(0);
        Cart::add($cart);
        return Redirect::to('/show_cart');
    }

    public function show_cart(){
        return view('client.cart');
    }

    public function delete_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show_cart');
    }

    public function update_qty(Request $request){
        $rowId = $request->row_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show_cart');
    }
}
