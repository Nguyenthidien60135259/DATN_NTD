<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Supplier;
use App\Models\Sex;
use App\Models\ProductTail;
use App\Models\Color;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


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

    public function index()
    {
        $product = $this->product->getAll();
        $category = $this->category->getAll();
        $supplier = $this->supplier->getAll();
        $sex = $this->sex->getAll();
        $product_tail = $this->product_tail->getAll();
        $color = $this->color->getAll();
        $size = $this->size->getAll();
        // dd($product);
        return response()->json([
            'data' => [
                'product' => $product,
                'category' => $category,
                'supplier' => $supplier,
                'sex' => $sex,
                'product_tail' => $product_tail,
                'color' => $color,
                'size' => $size
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'color_id' => 'required',
            'sex_id' => 'required',
            'stt' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'product_tail_id' => 'required',
            'list_image' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }

        $sup = $this->supplier->getSupplierById($request->supplier_id);
        $sup_code = $sup->code;
        $color = $this->color->getColorById($request->color_id);
        $cl_id = $color->code;
        $cate = $this->category->getCategoryById($request->category_id);
        $cate_id = $cate->code;
        $s = $this->sex->getSexById($request->sex_id);
        $sex_id = $s->code;
        $pt = $this->product_tail->getProTailById($request->product_tail_id);
        $product_tail_code = $pt->code;
        $code = $sup_code . $cate_id . $sex_id . $request->stt . $product_tail_code . $cl_id;
        $product = Product::create([
            'code' => $code,
            'name' => $request->name,
            'desc' => $request->desc,
            'color_id' => $request->color_id,
            'sex_id' => $request->sex_id,
            'supplier_id' => $request->supplier_id,
            'category_id' => $request->category_id,
            'product_tail_id' => $request->product_tail_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $product->save();

        $product_id = $product->id;

        $list_image = $request->list_image;

        for ($i = 0; $i < count($list_image); $i++) {
            $data_image = [
                'product_id' => $product_id,
                'image' => $list_image[$i],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $this->image->addImage($data_image);
        }

        // foreach ($list_image as $image){
        //     $product = Image::create([
        //                 'product_id' => $product_id,
        //                 'image' => $list_image[1],
        //                 'created_at' => Carbon::now(),
        //                 'updated_at' => Carbon::now()
        //             ]);
        //            $ima= $product->save();
        // }
        // dd($ima);
        return response()->json([
            'message' => "Thêm sản phẩm thành công"
        ]);
    }


    public function show(Request $request, $id)
    {
        $product = $this->product->getProductById($id);
        $category = $this->category->getAll();
        $size = $this->size->getAll();
        $supplier = $this->supplier->getAll();
        $sex = $this->sex->getAll();
        $product_tail = $this->product_tail->getAll();
        $color = $this->color->getAll();
        $images = $this->image->getAll();
        if ($product) {
            return response()->json([
                "data" => [
                    "product" => $product,
                    'category' => $category,
                    'size' => $size,
                    'supplier' => $supplier,
                    'sex' => $sex,
                    'product_tail' => $product_tail,
                    'color' => $color,
                    'images' => $images
                ]
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        $product = $this->product->getProductById($id);
        if ($product) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'color_id' => 'required',
                'sex_id' => 'required',
                'supplier_id' => 'required',
                'stt' => 'required',
                'category_id' => 'required',
                'product_tail_id' => 'required',
                'size' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $sup = $this->supplier->getSupplierById($request->supplier_id);
            $sup_code = $sup->code;
            $color = $this->color->getColorById($request->color_id);
            $cl_id = $color->code;
            $cate = $this->category->getCategoryById($request->category_id);
            $cate_id = $cate->code;
            $s = $this->sex->getSexById($request->sex_id);
            $sex_id = $s->code;
            $pt = $this->product_tail->getProTailById($request->product_tail_id);
            $product_tail_code = $pt->code;
            $code = $sup_code . $cate_id . $sex_id . $request->stt . $product_tail_code . $cl_id;
            $data = [
                'code' => $code,
                'name' => $request->name,
                'desc' => $request->desc,
                'color_id' => $request->color_id,
                'sex_id' => $request->sex_id,
                'supplier_id' => $request->supplier_id,
                'category_id' => $request->category_id,
                'product_tail_id' => $request->product_tail_id,
                'created_at' => Carbon::now(),
            ];
            // dd($data,$id);
            $this->product->updateProduct($id, $data);
            return response()->json([
                'message' => "Update Product Successfully!!",
                'data' => $product
            ]);
        } else {
            return response()->json(['message' => 'Not found product'], 404);
        }
    }


    public function destroy($id)
    {
        $product = $this->product->getProductById($id);
        $image = $this->image->getImageByProductId($id);
        if ($product) {
            if ($image) {
                $this->image->deleteImage($id);
                $this->product->deleteProduct($id);
                return response()->json(["message" => "Delete successfully!"]);
            }
        } else {
            return response()->json(["message" => "Not found!"]);
        }
    }
}
