<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
 	protected $table = 'products';
     protected $fillable = [
        'code','name', 'desc', 'product_tail_id', 'supplier_id', 'sex_id', 'category_id','supplier_id','color_id'
    ];

    public function productSize(){
        return $this->hasMany('App\Models\ProductSize','product_id')->join('sizes as size', 'product_sizes.size_id', '=', 'size.id');
    }

    public function productImage(){
        return $this->hasMany('App\Models\Image','product_id');
    }

    public function getProductNam(){
        $product_nam = Product::with("productImage")->where('sex_id',4)->orWhere('sex_id',5)->get();
        return $product_nam;
    }

    public function getProductNu(){
        $product_nu = Product::with("productImage")->where('sex_id',6)->orWhere('sex_id',5)->get();
        return $product_nu;
    }
    
    public function getProductBeTrai(){
        $product_trai = Product::with("productImage")->where('sex_id',1)->orWhere('sex_id',2)->get();
        return $product_trai;
    }

    public function getProductBeGai(){
        $product_gai = Product::with("productImage")->where('sex_id',3)->orWhere('sex_id',2)->get();
        return $product_gai;
    }

    public function getProductSearch($key){
        $product_seach = Product::with("productImage")->where('name','like','%'.$key.'%')->get();
        return $product_seach;
    }

    public function getAll()
    {
        $result = DB::table('products')->get();
        return $result;
    }

    public function getProductById($id)
    {
        $result = Product::with("productSize")->with('productImage')->where('id', $id)->first();
        return $result;
    }

    public function updateProduct($id, $data)
    {
        DB::table('products')->where('id', '=', $id)->update($data);
    }

    public function deleteProduct($id)
    {
        DB::table('products')->where('id', $id)->delete();
    }

    public function addProduct($data)
    {
        DB::table('products')->insert($data);
    }

    //find products by color, size, sex
    public function findProduct($input)
    {
        $result = DB::table('products');
        // ->join('sizes as size', 'products.id', '=', 'size.product_id')
        // ->select(DB::Raw('products.*'));

        if (isset($input['size_name']) && !is_null($input['size_name'])) {
            $result->leftJoin('product_sizes as pro_size', 'products.id', '=', 'pro_size.product_id')
                ->leftJoin('sizes as size', 'pro_size.size_id', '=', 'size.id');
            $result->where('size.name', 'like', "%{$input['size_name']}%");
        }
        if (isset($input['color_name']) && !is_null($input['color_name'])) {
            $result->leftJoin('colors as color', 'products.color_id', '=', 'color.id');
            $result->where('color.name', 'like', "%{$input['color_name']}%");
        }
        if (isset($input['sex_name']) && !is_null($input['sex_name'])) {
            $result->leftJoin('sexs as sex', 'products.sex_id', '=', 'sex.id');
            $result->where('sex.name', 'like', "%{$input['sex_name']}%");
        }
        $result->select(
            'products.id',
            'products.code',
            'products.name',
            'products.color_id'
        );

        return $result->paginate(10);
    }

    //find products by name or code
    public function getProductByNameOrCode($key)
    {
        $result = DB::table('products')->where('name', 'like', "%$key%")->orWhere('code', 'like', "%$key%")->get();
        return $result;
    }

    //join product,size,image
    public function PSI()
    {
        $result = DB::table('products')
            ->leftJoin('product_sizes as pro_size', 'products.id', '=', 'pro_size.product_id')
            ->leftJoin('sizes as size', 'pro_size.size_id', '=', 'size.id')
            ->leftJoin('images as image', 'products.id', '=', 'image.product_id')
            ->get();
        return $result;
    }

    public function getProductByColor($color_id)
    {
        $result = DB::table('products')->where('color_id', '=', $color_id[0]->id)->get();
        return $result;
    }

    public function getProductNew()
    {
        $product_new = DB::table('products')
            ->orderBy('created_at', 'desc')->get();
        return $product_new;
    }

    public function getProductExpensive()
    {
        $product_expensive = DB::table('products')
            ->leftJoin('product_sizes as pro_size', 'products.id', '=', 'pro_size.product_id')
            ->orderBy('sale', 'desc')->get();
        return $product_expensive;
    }

    public function getProductCheap()
    {
        $product_cheap = DB::table('products')
            ->leftJoin('product_sizes as pro_size', 'products.id', '=', 'pro_size.product_id')
            ->orderBy('sale', 'asc')->get();
        return $product_cheap;
    }
}
