<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductTailController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    
    public function listProductTail()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/product_tail_list");
        $data = json_decode($response);
        $product_tail = $data->data->product_tail;
        // dd($data);
        return view("backend.product_tail.list", compact('product_tail'));
    }

    public function deleteProductTail(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/product_tail_delete/" . $request->id);
        return redirect("/product_tail_list");
    }

    public function createProductTail()
    {
        $this->AuthLogin();
        return view("backend.product_tail.create");
    }

    public function saveCreateProductTail(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/product_tail_create", [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect("/product_tail_list");
    }

    public function updateProductTail(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/product_tail_show/" . $id);
        $data = json_decode($response);
        $product_tail = $data->data->product_tail;
        // dd($product_tail->name);
        return view("backend.product_tail.update", compact('product_tail'));
    }

    public function saveUpdateProductTail(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        // dd($id);
        $response = Http::post("http://127.0.0.1:8001/api/product_tail_update/" . $id, [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        // $data = json_decode($response);
        // dd($data,$id);
        return redirect("/product_tail_list");
    }
}
