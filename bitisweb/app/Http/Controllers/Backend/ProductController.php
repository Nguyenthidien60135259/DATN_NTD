<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use CURLFile;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\Sex;
use App\Models\ProductTail;
use App\Models\Color;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct(
        Product $product,
        Category $category,
        Size $size,
        Supplier $supplier,
        Image $image,
        Sex $sex,
        ProductTail $product_tail,
        Color $color
    ) {
        $this->product = $product;
        $this->category = $category;
        $this->size = $size;
        $this->supplier = $supplier;
        $this->sex = $sex;
        $this->product_tail = $product_tail;
        $this->color = $color;
        $this->image = $image;
    }
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    public function listProduct()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/product_list");
        $data = json_decode($response);
        $product = $data->data->product;
        $category = $data->data->category;
        $supplier = $data->data->supplier;
        $sex = $data->data->sex;
        $product_tail = $data->data->product_tail;
        $color = $data->data->color;
        // foreach($product as $pro){
        //     $pro->size=[];
        //     foreach($size as $si){
        //         if(($pro->size_id) == ($si->id))
        //         {
        //             array_push($pro->size,$si);
        //         }
        //     }
        // }
        foreach ($category as $type) {
            $type->product = [];
            foreach ($product as $item) {
                if (($item->category_id) == ($type->id)) {
                    array_push($type->product, $item);
                }
            }
        }
        return view("backend.product.list", compact('product', 'category', 'supplier', 'sex', 'product_tail', 'color'));
    }

    public function deleteProduct(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/product_delete/" . $request->id);
        // dd($data = json_decode($response));
        return redirect("/product_list");
    }

    public function createProduct(Request $request)
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/product_list");
        $data = json_decode($response);
        $category = $data->data->category;
        $supplier = $data->data->supplier;
        $sex = $data->data->sex;
        $product_tail = $data->data->product_tail;
        $color = $data->data->color;
        $size = $data->data->size;
        // $images = $data->data->image;
        return view("backend.product.create", compact('category', 'supplier', 'sex', 'product_tail', 'color', 'size'));
    }

    public function saveCreateProduct(Request $request)
    {
        $this->AuthLogin();
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:50',
            'color_id' => 'required',
            'sex_id' => 'required',
            'stt' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'product_tail_id' => 'required',
            'size' => 'required',
            'price' => 'required',
            'sale' => 'required',
            'discount' => 'required',
            'amount' => 'required'
        ]);
        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/fronend/images/products/', $name);
                $list_image[] = $name;
            }
        }
        if ($request->hasfile('size')) {
            foreach ($request->size as $size) {
                $name = $size->getClientOriginalName();
                $list_size[] = $name;
            } 
        }
        // dd($list_size);
        // dd(count($list_image));
        $response = Http::post("http://127.0.0.1:8001/api/product_create", [
            'name' => $request->name,
            'desc' => $request->desc,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'sex_id' => $request->sex_id,
            'product_tail_id' => $request->product_tail_id,
            'stt' => $request->stt,
            'color_id' => $request->color_id,
            'list_image' => $list_image
        ]);
        $data = json_decode($response);
        // $list_image1 = $data->data->list_image;
        // dd($data);
        return redirect("/product_list");
    }

    public function updateProduct(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/product_show/" . $id);
        $data = json_decode($response);
        $product = $data->data->product;
        $category = $data->data->category;
        $size = $data->data->size;
        $supplier = $data->data->supplier;
        $sex = $data->data->sex;
        $product_tail = $data->data->product_tail;
        $color = $data->data->color;
        $stt = substr($product->code, 3, 4);
        $images = $data->data->images;
        // dd($images);
        return view("backend.product.update", compact('product', 'images', 'category', 'supplier', 'product_tail', 'sex', 'color', 'stt'));
    }

    public function saveUpdateProduct(Request $request)
    {
        $this->AuthLogin();
        // $code = substr($request->supplier_id,-1,1).substr($request->category_id,-1,1).substr($request->sex_id,-1).$request->stt.substr($request->product_tail_id,-2).substr($request->color_id,-3);
        $id = $request->id;
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:50',
            'color_id' => 'required',
            'sex_id' => 'required',
            'stt' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'product_tail_id' => 'required',
            'size' => 'required',
            'price' => 'required',
            'sale' => 'required',
            'discount' => 'required',
            'amount' => 'required'
        ]);
        if ($request->hasfile('filename')) {
            foreach ($request->file('filename') as $image) {
                $name = $image->getClientOriginalName();
                $image->move(public_path() . '/fronend/images/products/', $name);
                $list_image[] = $name;
            }
        }
        if ($request->hasfile('size')) {
            foreach ($request->size as $size) {
                $name = $size->getClientOriginalName();
                $list_size[] = $name;
            } 
        }
        // dd($id);
        $response = Http::post("http://127.0.0.1:8001/api/product_update/" . $id, [
            // 'code' => $code,
            'name' => $request->name,
            'desc' => $request->desc,
            'color_id' => $request->color_id,
            'sex_id' => $request->sex_id,
            'supplier_id' => $request->supplier_id,
            'stt' => $request->stt,
            'category_id' => $request->category_id,
            'product_tail_id' => $request->product_tail_id,
        ]);
        $data = json_decode($response);
        // dd($data);
        return redirect("/product_list");
    }
}
