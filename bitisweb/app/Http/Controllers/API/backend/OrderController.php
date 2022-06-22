<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Statistical;
use App\Models\Product;

class OrderController extends Controller
{
    public function __construct(
        Product $product,
        User $user,
        Order $order,
        OrderDetail $order_detail,
        Statistical $statis 
        
    )
    {
        $this->product = $product;
       $this->user =$user;
       $this->order = $order;
       $this->order_detail = $order_detail;
       $this->statis = $statis;
    }

    public function index()
    {
        $all_order = $this->order->getAllOrder();
        return response()->json([
            "data"=>[
                "all_order"=>$all_order
            ]
        ]);
    }

    public function show($id)
    {
        $order_detail = $this->order->getOrderById($id);
        return response()->json([
           "data"=>[
               "order"=>$order_detail
           ]
        ]);
    }

    public function print_order($id)
    {
        $order = $this->order->getOrderById($id);
        $order_detail = $this->order_detail->getOrderDetailById($order->id);
        $product = OrderDetail::with("product")->where("order_id",$id)->get();
        $user = User::all()->where('id',$order->user_id);
        return response()->json([
           "data"=>[
               "order"=>[$order],
               "order_detail"=>$order_detail,
               "user"=>$user,
               "product"=>$product,
           ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order_date = $order->order_date;
        $statistic = Statistical::where("order_date",$order_date)->get();
        $order_detail = OrderDetail::where("order_id",$id)->get();
        $product = OrderDetail::with("product")->where("order_id",$id)->get();
        $size = OrderDetail::with("size")->where("order_id",$id)->get();

        foreach($order_detail as $or)
        {
            $listTopping = explode(",",$or->listTopping);
        }
        $count = count($listTopping);


        if($statistic)
        {
            $statistic_count = $statistic->count();
        }
        else{
            $statistic_count = 0;
        }

        if($order->status == 1)
        {
            $order_total = 0;
			$sales = 0;
			$profit = 0;
			$quantity = 0;
            foreach($order_detail as $or)
            {
                if($count > 1)
                {
                    foreach($product as $pro)
                    {
                            if($or->product_id == $pro->product_id)
                            {
                                $order_total+=1;
                                $quantity += $or->quantity;
                                $profit += ($pro->product->price - $pro->product->price_cost) * $or->quantity;
                                $sales += ($or->quantity * $pro->product->price) + $count * 5000;
                            }
                    }
                }
                else
                {
                    foreach($product as $pro)
                    {
                        if($or->product_id == $pro->product_id)
                        {
                            $order_total+=1;
                            $quantity += $or->quantity;
                            $profit += ($pro->product->price - $pro->product->price_cost) * $or->quantity;
                            $sales += ($or->quantity * $pro->product->price);
                        }
                    }
                }
            }

            if($statistic_count>0){
				$statistic_update = Statistical::where('order_date',$order_date)->first();
				$statistic_update->sales = $statistic_update->sales + $sales;
				$statistic_update->profit =  $statistic_update->profit + $profit;
				$statistic_update->quantity =  $statistic_update->quantity + $quantity;
				$statistic_update->order_total = $statistic_update->order_total + $order_total;
				$statistic_update->save();
			}
			else{

				$statistic_new = new Statistical();
				$statistic_new->order_date = $order_date;
				$statistic_new->sales = $sales;
				$statistic_new->profit =  $profit;
				$statistic_new->quantity =  $quantity;
				$statistic_new->order_total = $order_total;
				$statistic_new->save();
			}
        }
        $order->update();
        return response()->json([
           "message" => "Update Successfully!!",
           "data" => [
               "statistic"=>$statistic
           ]
        ]);
    }
}
