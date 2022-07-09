<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function __construct(
        Supplier $supplier
    ) {
        $this->supplier = $supplier;
    }
    public function index()
    {
        $supplier = $this->supplier->getAll();
        return response()->json(['data' => ["supplier" => $supplier]]);
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
            'code' =>$code,
            'name' => $request->name,
            'created_at' =>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        $this->supplier->addSupplier($data);

        return response()->json([
            "message" => "Tạo thành công",
        ]);
    }


    public function show($id)
    {
        $supplier = $this->supplier->getSupplierById($id);
        if ($supplier) {
            return response()->json(['data' => ["supplier" => $supplier]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        $supplier = $this->supplier->getSupplierById($id);
        if ($supplier) {
            $validator = Validator::make($request->all(), [
                'code' => 'required|string',
                'name' => 'required|string|max:50',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $code = strtoupper($request->code);
            $data = [
                'code' =>$code,
                'name' => $request->name,
                'created_at' =>Carbon::now()
            ];
            $this->supplier->updateSupplier($id,$data);
            return response()->json([
                'message' => "Cập nhật thành công!"
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy!"], 404);
        }
    }


    public function destroy($id)
    {
        $supplier = $this->supplier->getSupplierById($id);
        if ($supplier) {
            $this->supplier->deleteSupplier($id);
            return response()->json(['message' => 'Xóa thành công!']);
        }
        return response()->json(["message" => "Không tìm thấy!!"]);
    }
}
