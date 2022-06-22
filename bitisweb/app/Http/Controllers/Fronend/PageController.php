<?php

namespace App\Http\Controllers\Fronend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    // public function __construct(
    //     Product $product,
    //     Color $color,
    //     Comment $comment,
    //     Category $category,
    //     User $user,
    //     Size $size,
    //     Images $image,
    //     Sex $sex
    // )
    // {
    //     $this->product = $product;
    //     $this->color = $color;
    //     $this->comment = $comment;
    //     $this->category = $category;
    //     $this->user = $user;
    //     $this->size = $size;
    //     $this->image = $image;
    //     $this->sex = $sex;
    // }

    public function index()
    {
        return view('client.home');
    }

    public function menu()
    {
        $response = Http::get("http://127.0.0.1:8001/api/menu");
        $data = json_decode($response);
        $product_expensive = $data->data->product_expensive;
        $product_cheap = $data->data->product_cheap;
        $product_new = $data->data->product_new;
        $product_nam = $data->data->product_nam;
        $product_nu = $data->data->product_nu;
        $product_trai = $data->data->product_trai;
        $product_gai = $data->data->product_gai;
        // dd($product_nam[0]->product_image[0]->image);
        return view('client.shop', compact('product_new','product_cheap','product_expensive','product_nam','product_nu','product_trai','product_gai'));
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function getDetail(Request $request)
    {
        $response = Http::get("http://127.0.0.1:8001/api/detail/".$request->id);
        $data = json_decode($response);
        // dd($data);
        $product = $data->data->product;
        $sizes = $data->data->sizes;
        // dd($product->product_size[0]->size_id);
        // for($i=0;$i<count($product->product_size);$i++){
        //     foreach($sizes as $size){
        //         if($product->product_size[0]->size_id == $size->id){
        //             return $size->size;
        //         }
        //     }
           
        // }
// dd($product);
       
        return view('client.detail',compact('product','sizes'));
    }

    public function tail(){
        return view('client.detail');
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function wishlist()
    {
        return view('client.wishlist');
    }

    public function about()
    {
        return view('client.about');
    }

    public function blog_single()
    {
        return view('client.blog-single');
    }

    public function detail()
    {
        $response = Http::get("http://127.0.0.1:8001/api/homess");
        $data = json_decode($response);
        // dd($data);
        $sexs = $data->data->sexs;
        // $PSI = $data->data->PSI;
        $products = $data->data->products;
        $images = $data->data->images;
        $product_expensive = $data->data->product_expensive;
        $product_cheap = $data->data->product_cheap;
        $product_new = $data->data->product_new;
        $home_products_image=$data->data->home_products_image;
        $home_products_size = $data->data->home_products_size;
        // dd($products_new);
        return view('client.detail', compact('sexs', 'images','products', 'home_products_size','home_products_image','product_new','product_cheap','product_expensive'));
    }

    public function search(Request $request)
    {
        
        $response = Http::post("http://127.0.0.1:8001/api/search/", [
            'keywords' => $request->key
        ]);
        $data = json_decode($response);
        $search_product = $data->data->product_search;
        return view('client.search',compact('search_product'));
    }
}
