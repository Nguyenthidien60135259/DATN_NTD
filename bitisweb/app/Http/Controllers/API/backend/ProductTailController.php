<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductTail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class ProductTailController extends Controller
{
    public function __construct(
        ProductTail $product_tail
    ) {
        $this->product_tail = $product_tail;
    }
    public function index()
    {
        $product_tail = $this->product_tail->getAll();
        return response()->json(['data' => ["product_tail" => $product_tail]]);
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
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $this->product_tail->addProTail($data);

        return response()->json([
            "message" => "Tạo thành công!",
        ]);
    }


    public function show($id)
    {
        $product_tail = $this->product_tail->getProTailById($id);
        if ($product_tail) {
            return response()->json(['data' => ["product_tail" => $product_tail]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        $product_tail = $this->product_tail->getProTailById($id);
        if ($product_tail) {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string',
                'name' => 'required|string|max:50'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $data = [
                'code' => $request->code,
                'name' => $request->name,
                'created_at' => Carbon::now(),
            ];
            $this->product_tail->updateProTail($id, $data);
            return response()->json([
                'message' => "Cập nhật thành công!"
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy!"], 404);
        }
    }

    public function destroy($id)
    {
        $product_tail = $this->product_tail->getProTailById($id);
        if ($product_tail) {
            $this->product_tail->deleteProTail($id);
            return response()->json(["message" => "Xóa thành công!"]);
        } else {
            return response()->json(["message" => "Không tìm thấy!"]);
        }
    }
}
