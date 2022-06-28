<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Statistical;

class StatisticalController extends Controller
{
    public function __construct(
        Product $product,
        Category $category,
        Comment $comment,
        Customer $customer,
        Order $order
    ) {
        $this->product = $product;
        $this->category = $category;
        $this->order = $order;
        $this->comment = $comment;
        $this->customer = $customer;
    }
    public function index()
    {
        $product = $this->product->getAll()->count();
        $category = $this->category->getAll()->count();
        $order = $this->order->getAllOrder()->count();
        $comment = $this->comment->getAll()->count();
        $customer = $this->customer->getAll()->count();

        return response()->json([
            "data"=>[
                "product"=>$product,
                "category"=>$category,
                "order"=>$order,
                "comment"=>$comment,
                "customer"=>$customer
            ]
        ]);
    }
    
    
    // from date, to date
    public function filter_by_date(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $statistical = Statistical::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        
        return response()->json([
            "data"=> [
                "from_date"=>$from_date,
                "to_date"=>$to_date,
                "statistical"=>$statistical,
                
            ]
        ]);
    }
    
    // 7 days before
    public function subs365days(Request $request)
    {
        $subs365days = $request->input("subs7days");
        $subs365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $statistical = Statistical::whereBetween('order_date',[$subs365days,$now])->orderBy('order_date','ASC')->get();
        return response()->json([
            'data'=>[
                "statistical" => $statistical
            ]
        ]);
    }
    
    // // // 60 days trước
    // public function sub60days(Request $request)
    // {
    //     $sub60days = $request->input("sub60days");
    //     $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
    //     $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    //     $statistical = Statistical::whereBetween('order_date',[$sub60days,$now])->orderBy('order_date','ASC')->get();
    //     return response()->json([
    //         "data"=>[
                
    //             "statistical" => $statistical
    //         ]
    //     ]);
    // }
    
    // tháng này
    public function thisMonth(Request $request)
    {
        $thisMonth = $request->input("thisMonth");
        $thisMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $statistical = Statistical::whereBetween('order_date',[$thisMonth,$now])->orderBy('order_date','ASC')->get();
        return response()->json([
            "data"=>[
                "statistical" => $statistical
            ]
        ]);
    }
}
