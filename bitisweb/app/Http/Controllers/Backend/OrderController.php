<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

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
        
    public function orderList()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/order_list");
        $data = json_decode($response);
        $all_order = $data->data->all_order;
        return view("backend.order.list",compact('all_order'));
    }


    function orderDetail(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/order_show/".$id);
        $data = json_decode($response);
        $order_detail = $data->data->order;
        // dd($order_detail);
        return view("backend.order.detail",compact('order_detail'));
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




    public function print_order_PDF(Request $request,$id)
    {
        $id = $request->id;
        $api_response = Http::get("http://api.bitisnhatrang.cf/api/print_order/".$id);
        $data = json_decode($api_response);
        $order = $data->data->order;
        $customer = $data->data->customer;
        $order_detail = $data->data->order_detail;
        $product = $data->data->product;

        $context = [
          "id"=>$id,
          "order"=>$order,
          "customer"=>$customer,
          "order_detail"=>$order_detail,

          "product"=>$product
        ];

        $pdf = PDF::loadView("admin.pdf",$context);
        return $pdf->stream();
    }

    
}
