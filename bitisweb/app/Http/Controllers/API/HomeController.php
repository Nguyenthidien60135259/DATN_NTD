<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Comment;
use App\Models\User;
use App\Models\Size;
use App\Models\Image;
use App\Models\Category;
use App\Models\Sex;
use App\Models\ProductSize;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function __construct(
        Product $product,
        Color $color,
        Comment $comment,
        Category $category,
        User $user,
        Size $size,
        Image $image,
        Sex $sex,
        ProductSize $pro_size
    )
    {
        $this->product = $product;
        $this->color = $color;
        $this->comment = $comment;
        $this->category = $category;
        $this->user = $user;
        $this->size = $size;
        $this->image = $image;
        $this->sex = $sex;
        $this->pro_size = $pro_size;
    }

    public function getProductByNameOrCode(Request $request)
    {
        $key = $request->key;
        $products = $this->product->getProductByNameOrCode($key); 
        return response()->json(['product' => $products]);
    }

    public function findProduct(Request $request){
        $input = $request->all();
        $products = $this->product->findProduct($input);
        return response()->json(['product' => $products]);
    }

    public function detail(Request $request)
    {
        $product = $this->product->getProductById($request->id);
        $comment = $this->comment->getCommenyByProductId($request->id);
        $size = $this->size->getAll();
        return response()->json([
            'data' => [
                'sizes' =>$size,
                'product' => $product,
                'comment' => $comment 
            ]
        ]);
    }

    // public function menu()
    // {
    //     $products = $this->product->getAllProduct();
    //     $sizes = $this->size->getAllSize();
    //     $images = $this->image->getAllImage();
    //     $category = $this->category->getAll();
    //     $sexs = $this->sex->getAll();
        
    //     $productsize = Product::with("productsize")->get();
    //     $products_image = Product::with("image")->get();
        
    //     return response()->json([
    //         'data' => [
    //             'products' => $products,
    //             'sizes' => $sizes,
    //             'images' => $images,
    //             'category' => $category,
    //             'sexs' => $sexs,
    //         ]
    //     ]);
    // }

    public function menu()
    {
        $products = $this->product->getAll();
        $sizes = $this->size->getAll();
        $images = $this->image->getAllImage();
        $category = $this->category->getAll();
        $sexs = $this->sex->getAll();
        $product_new=$this->product->getProductNew();
        $product_cheap=$this->product->getProductCheap();
        $product_expensive=$this->product->getProductExpensive();
        $product_nam=$this->product->getProductNam();
        $product_nu=$this->product->getProductNu();
        $product_trai=$this->product->getProductBeTrai();
        $product_gai=$this->product->getProductBeGai();
        // $home_products_size =[];
        // foreach($products as $product){
        //     array_push($home_products_size,$this->pro_size->getSizeByProductId($product->id));
        // }
        // // dd($home_products_size);
        // $home_products_image =[];
        // foreach($products as $product){
        //     array_push($home_products_image,$this->image->getImageByProductId($product->id));   
        // }
        
        return response()->json([
            'data' => [
                'products' => $products,
                'sizes' => $sizes,
                'images' => $images,
                'category' => $category,
                'sexs' => $sexs,
                'product_new'=>$product_new,
                'product_expensive'=>$product_expensive,
                'product_cheap'=>$product_cheap,
                'product_nam'=>$product_nam,
                'product_nu'=>$product_nu,
                'product_trai'=>$product_trai,
                'product_gai'=>$product_gai
            ]
        ]);
    }

    public function manangerProfile(Request $request){
        $id = $request->id;
        $user = $this->user->getUserId($id);
        return response()->json([
            'data' => [
                'user' => $user
            ]
        ]);
    }

    public function add_cart(Request $request){
        $product = $this->product->getProductById($request->id);
        return response()->json([
            'data' => [
                'product' => $product
            ]
        ]);
    }
//ADD user
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32',
            'passwordAgain' => 'required|same:password',
            'dateOfBirth' => 'required|date',
            'phone' => 'required|between:10,12',
            'sex' => 'required|boolean',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'dateOfBirth' => $request->dateOfBirth,
            'phone' => $request->phone,
            'sex' => $request->sex,
            'address' => $request->address,
            'roles_id' => $request->roles_id = 3
        ]);
        $user->save();

        return response()->json([
            'message' => 'User successfully registered',
            'data'=>[
                'user'=>$user,
            ]
        ], 201);
    }

    public function search_product(Request $request){
        $key = $request->keywords;
        $product_search = $this->product->getProductSearch($key);
        return response()->json([
            'data' => [
                'product_search' => $product_search
            ]
        ]);
    }

    public function postComment(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'customer_id' => 'required',
            'product_id' => 'required',
            'comment' => 'required'
         ]);
         if($validator->fails())
         {
             return response()->json(['message'=>$validator->errors()],422);
         }
         
        // $cus_id = $request->customer_id;
        // dd($request->customer_id,$request->product_id,$request->comment);
        $data = [
            "customer_id" =>$request->customer_id,
            "product_id" => $request->product_id,
            "comment" => $request->comment,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $this->comment->addComment($data);
        return response()->json([
            "message" => "Viết bình luận thành công",
        ]);
    }
}
