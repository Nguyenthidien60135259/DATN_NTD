<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class StatisticalController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }

    function chartInventory()
    {
        $this->AuthLogin();
        $api_response = Http::get("http://127.0.0.1:8001/api/inventory_list");
        $data = json_decode($api_response);
        $product = $data->data->product;
        $category = $data->data->category;
        $order = $data->data->order;
        $comment = $data->data->comment;
        $customer = $data->data->customer;
        $context = [
            "product" => $product,
            "category" => $category,
            "order" => $order,
            "comment" => $comment,
            "customer" => $customer
        ];
        return view("backend.inventory.chart", $context);
    }


    // from_date, to_date
    function filter_by_date(Request $request)
    {
        $this->AuthLogin();
        $data = [
            "from_date" => $request->from_date,
            "to_date" => $request->to_date
        ];
        $api_response = Http::post("http://127.0.0.1:8001/api/filter_by_date/", $data);
        $data = json_decode($api_response);

        $statistical = $data->data->statistical;

        foreach ($statistical as $key => $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order_total' => $value->order_total,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    // 7 days before
    function subs365days(Request $request)
    {
        $this->AuthLogin();
        $data_0 = [
            'subs365days' => $request->subs365days
        ];
        $api_response = Http::post("http://127.0.0.1:8001/api/subs365days/", $data_0);
        $data_0 = json_decode($api_response);
        $statistical = $data_0->data->statistical;
        foreach ($statistical as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order_total' => $val->order_total,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data_0 = json_encode($chart_data);
    }


    // this month
    function thisMonth(Request $request)
    {
        $this->AuthLogin();
        $data_2 = [
            'thisMonth' => $request->thisMonth
        ];
        $api_response = Http::post("http://127.0.0.1:8001/api/thisMonth/", $data_2);
        // dd($api_response);
        $data_2 = json_decode($api_response);
        $statistical = $data_2->data->statistical;
        foreach ($statistical as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order_total' => $val->order_total,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data_2 = json_encode($chart_data);
    }
}
