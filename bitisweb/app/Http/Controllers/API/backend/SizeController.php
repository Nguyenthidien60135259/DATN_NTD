<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class SizeController extends Controller
{
    public function __construct(
        Size $size
    ) {
        $this->size = $size;
    }
    public function index()
    {
        $size = $this->size->getAll();
        return response()->json(['data' => ["size" => $size]]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|numeric|unique:sizes',
        ]);

        // check validator ?
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
        $data = [
            'size' => $request->size,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $this->size->addSize($data);

        return response()->json([
            "message" => "Tạo thành công!",
        ]);
    }

    public function show($id)
    {
        $size = $this->size->getSizeById($id);
        if ($size) {
            return response()->json(['data' => ["size" => $size]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        $size = $this->size->getSizeById($id);
        if ($size) {
            $validator = Validator::make($request->all(), [
                'size' => 'required|numeric|unique:sizes',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $data = [
                'size' => $request->size,
                'created_at' => Carbon::now()
            ];
            $this->size->updateSize($id, $data);
            return response()->json([
                'message' => "Cập nhật thành công!"
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy"], 404);
        }
    }
    public function destroy($id)
    {
        $size = $this->size->getSizeById($id);
        if ($size) {
            $this->size->deleteSize($id);
            return response()->json(["message" => "Xóa thành công!"]);
        } else {
            return response()->json(["message" => "Không tìm thấy!"]);
        }
    }
}
