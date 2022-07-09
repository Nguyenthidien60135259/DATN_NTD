<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    public function index()
    {
        //
        $category = $this->category->getAll();
        return response()->json(['data' => ["category" => $category]]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string|max:50'
        ]);

        // check validator ?
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $code = strtoupper($request->code);
        $data = [
            'code' => $code,
            'name' => $request->name
        ];
        $this->category->addCategory($data);
        
        return response()->json([
            "message" => "Đã tạo thành công",
        ]);
    }


    public function show($id)
    {
        $category = $this->category->getCategoryById($id);
        if ($category) {
            return response()->json(['data' => ["category" => $category]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        // dd($request->name);
        // exit();
        $category = $this->category->getCategoryById($id);
        if ($category) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'code' => 'required|string'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $code = strtoupper($request->code);
            $data = [
                'code' =>$code,
                'name'=>$request->name
            ];
            $this->category->updateCategory($id,$data);
            return response()->json([
                'message' => "Cập nhật thành công",
                
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy"], 404);
        }
    }


    public function destroy($id)
    {
        $category = $this->category->getCategoryById($id);
        if ($category != null) {
            $this->category->deleteCategory($id);
            return response()->json(['message' => 'Delete Successfully']);
        }
        return response()->json(["message" => "Không tìm thấy!!"]);
    }
}
