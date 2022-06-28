<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Statistical;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function __construct(
        Product $product,
        User $user,
        Order $order,
        ProductSize $pro_size,
        OrderDetail $order_detail,
        Statistical $statis

    ) {
        $this->product = $product;
        $this->user = $user;
        $this->order = $order;
        $this->pro_size = $pro_size;
        $this->order_detail = $order_detail;
        $this->statis = $statis;
    }

    public function index()
    {
        $all_order = $this->order->getAllOrder();
        return response()->json([
            "data" => [
                "all_order" => $all_order
            ]
        ]);
    }

    public function show($id)
    {
        $order_detail = $this->order->getOrderById($id);
        return response()->json([
            "data" => [
                "order" => $order_detail
            ]
        ]);
    }

    public function print_order($id)
    {
        $order = $this->order->getOrderById($id);
        $order_detail = $this->order_detail->getOrderDetailById($order->id);
        $product = OrderDetail::with("product")->where("order_id", $id)->get();
        $user = User::all()->where('id', $order->user_id);
        return response()->json([
            "data" => [
                "order" => [$order],
                "order_detail" => $order_detail,
                "user" => $user,
                "product" => $product,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $data_order = [
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ];
        $this->order->updateOrder($id, $data_order);

        $productSize = ProductSize::where("size_id", $request->product_size)->where('product_id', $request->product_id)->first();
        $order = $this->order->getOrderById($id);

        if ($request->status == 1) {
            $data_ps = [
                'amount' => $productSize->amount - $request->product_qty,
                'updated_at' => Carbon::now()
            ];
            $this->pro_size->updateProductSize($productSize->size_id, $productSize->product_id, $data_ps);
        }

        if ($request->status == 2) {
            $data_ps = [
                'amount' => $productSize->amount + $request->product_qty,
                'updated_at' => Carbon::now()
            ];
            $this->pro_size->updateProductSize($productSize->size_id, $productSize->product_id, $data_ps);
        }
        $order_detail = $this->order_detail->getOrderDetailById($id);
        // $product = $this->order_detail->getProductOder($id);

        $product = $this->pro_size->getProductSize($request->product_id, $request->product_size);
        // dd($product);
        $statistic = Statistical::where("order_date", $order->created_at)->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        } else {
            $statistic_count = 0;
        }

        if ($order->status == 1) {
            $order_total = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            // $count = count($product);
            if ($statistic_count > 0) {
                foreach ($product as $pro) {
                    $order_total += 1;
                    $quantity += $order_detail->quantity;
                    $profit += ($pro->sale - $pro->price) * $order_detail->quantity;
                    $sales += ($order_detail->quantity * $pro->sale);
                }
                $statistic_update = Statistical::where('order_date', $order->created_at)->first();
                $data_statis = [
                    'order_date' => $productSize->amount - $request->qty,
                    'sale' => $statistic_update->sale + $sales,
                    'profit' => $statistic_update->profit + $profit,
                    'quantity' => $statistic_update->quantity + $quantity,
                    'order_total' => $statistic_update->order_total + $order_total,
                    'updated_at' => Carbon::now()
                ];

                $this->statis->updateStatistical($statistic_update->id, $data_statis);
            } else {
                foreach ($product as $pro) {
                $order_total += 1;
                $quantity += $order_detail->quantity;
                $profit += ($pro->sale - $pro->price) * $order_detail->quantity;
                $sales += ($order_detail->quantity * $pro->sale);
                }
                
                $data_statis = [
                    'order_date' => Carbon::parse($order->created_at)->format('Y-m-d'),
                    'sale' => $sales,
                    'profit' => $profit,
                    'quantity' => $quantity,
                    'order_total' => $order_total,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $this->statis->addStatistical($data_statis);
            }
        }
        return response()->json([
            "message" => "Update Successfully!!",

        ]);
    }
}
