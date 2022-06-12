<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
        
    function orderList()
    {
        $this->AuthLogin();
        $api_response = Http::get("http://127.0.0.1:8001/api/order_list");
        $data = json_decode($api_response);
        $order = $data->data->order;
        $user = $data->data->user;
        foreach($order as $type){
            $type->user=[];
            foreach($user as $user){
                if($type->customer_id == $user->id){
                    array_push($type->user,$user);
                }
            }
        }
        $context = [
          "order"=>$order,
          "user"=>$user
        ];
        return view("admin.order.list",$context);
    }


    function orderDetail(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $api_response = Http::get("http://127.0.0.1:8001/api/order_show/".$id);
        $data = json_decode($api_response);
        $order = $data->data->order;
        $user = $data->data->user;
        $order_detail = $data->data->order_detail;
        $product = $data->data->product;
        $size = $data->data->size;


        // foreach($order_detail as $type){
        //     $type->product=[];
        //     foreach($product as $item){
        //         if($type->product_id == $item->product->id){
        //             array_push($type->product,$item);
        //         }
        //     }
        // }


        // foreach($product as $type){
        //     $type->size=[];
        //     foreach($size as $item){
        //         if($type->product->size_id == $item->size->id){
        //             array_push($type->size,$item);
        //         }
        //     }
        // }


        $context = [
          "id"=>$id,
          "order"=>$order,
          "user"=>$user,
          "order_detail"=>$order_detail,
          "product"=>$product,
          "size"=>$size,
        ];

        return view("admin.order.detail",$context);
    }


    function updateOrder(Request $request)
    {
        $this->AuthLogin();
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://127.0.0.1:8001/api/order_update/'.$request->id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>array(
                                "id" => $request->id,
                                "status" => $request->status,
                            ),

        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    
}
