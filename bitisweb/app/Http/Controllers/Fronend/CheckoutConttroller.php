<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutConttroller extends Controller
{
   public function login_checkout()
   {
      return view('client.login_checkout');
   }

   public function add_user(Request $request)
   {

      $validator = Validator::make($request->all(), [
         'name' => 'required|min:6',
         'email' => 'required|email|unique:users,email',
         'password' => 'required|min:6|max:32',
         'passwordAgain' => 'required|same:password',
         'dateOfBirth' => 'required|date',
         'phone' => 'required|between:10,12',
         'sex' => 'required|boolean',
         'address' => 'required|string|between:10,100'
      ]);

      if ($validator->fails()) {
         return back()->with('message', $validator->errors());
      }
      $data = array();
      $data['name'] = $request->name;
      $data['email'] = $request->email;
      $data['password'] = md5($request->password);
      $data['birthday'] = $request->dateOfBirth;
      $data['phone'] = $request->phone;
      $data['sex'] = $request->sex;
      $data['address'] = $request->address;
      $data['role_id'] = 3;
      $data['created_at'] = Carbon::now();
      $data['updated_at'] = Carbon::now();
      $customer_id = DB::table('customers')->insertGetId($data);
      $dataa=[
         'name' => $request->name,
         'email' => $request->email,
         'password' => md5($request->password),
         'address' => $request->address,
         'phone' =>$request->phone,
         'birthday' =>$request->dateOfBirth,
         'sex'=>$request->sex,
         'role_id' => 3,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now()
      ];
       DB::table('users')->insert($dataa);
      Session::put('customer_id', $customer_id);
      Session::put('customer_name', $request->name);
      return redirect('/checkout');
   }
   public function checkout()
   {

      return view('client.checkout');
   }

   public function save_checkout(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'shipping_name' => 'required',
         'shipping_email' => 'required|email|unique:customers,email',
         'shipping_phone' => 'required|between:10,12',
         'shipping_address' => 'required|string|between:10,100'
      ]);
      if ($validator->fails()) {
         return back()->with('message', $validator->errors());
      }
      $data = array();
      $data['shipping_name'] = $request->shipping_name;
      $data['shipping_email'] = $request->shipping_email;
      $data['shipping_phone'] = $request->shipping_phone;
      $data['shipping_address'] = $request->shipping_address;
      $data['shipping_note'] = $request->shipping_note;
      $shipping_id = DB::table('shippings')->insertGetId($data);
      Session::put('shipping_id', $shipping_id);
      return redirect('/payment');
   }

   public function payment()
   {
      return view('client.payment');
   }
   public function logout_checkout()
   {
      Session::flush();
      return Redirect('/login_checkout');
   }

   public function login_customer(Request $request)
   {
      $email = $request->email;
      $password = md5($request->password);

      $result = DB::table('customers')->where('email', $email)->where('password', $password)->first();

      if ($result) {
         Session::put('customer_id', $result->id);
         return Redirect('/checkout');
      } else {
         return Redirect('/login_checkout');
      }
   }

   public function order_place(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'payment_option' => 'required',
      ]);

      if ($validator->fails()) {
         return back()->with('message', $validator->errors());
      }
      //payment
      $data = array();
      $data['payment_method'] = $request->payment_option;
      $data['payment_status'] = '0';
      $data['created_at'] = Carbon::now();
      $data['updated_at'] = Carbon::now();
      $payment_id = DB::table('payments')->insertGetId($data);

      //order
      $order_data = array();
      $order_data['customer_id'] = Session::get('customer_id');
      $order_data['shipping_id'] = Session::get('shipping_id');
      $order_data['total'] = Cart::total(0, ',', '');
      $order_data['payment_id'] = $payment_id;
      $order_data['status'] = '0';
      $order_data['created_at'] = Carbon::now();
      $order_data['updated_at'] = Carbon::now();
      $order_id = DB::table('orders')->insertGetId($order_data);

      $content  = Cart::content();
      //order_detail
      foreach ($content as $v_content) {
         $size = DB::table('sizes')->where('size', $v_content->options->size)->first();
         $product = DB::table('products')->where('id', $v_content->id)->first();

         $pro_color = substr($product->code, -3);
         $color = DB::table('colors')->where('code', $pro_color)->first();
         $order_detail_data = array();
         $order_detail_data['order_id'] = $order_id;
         $order_detail_data['product_id'] = $v_content->id;
         $order_detail_data['product_name'] = $v_content->name;
         $order_detail_data['product_price'] = $v_content->price;
         $order_detail_data['quantity'] = $v_content->qty;
         $order_detail_data['size_id'] = $size->id;
         $order_detail_data['color_id'] = $color->id;
         $order_detail_data['created_at'] = Carbon::now();
         $order_detail_data['updated_at'] = Carbon::now();
         DB::table('order_details')->insert($order_detail_data);
      }
      if ($data['payment_method'] == 1) {
         echo ' Thanh toán bằng ATM';
      } elseif ($data['payment_method'] == 2) {
         Cart::destroy();
         return view('client.handcash');
      } else {
         echo ' Thanh toán bằng PayPal';
      }
   }
}
