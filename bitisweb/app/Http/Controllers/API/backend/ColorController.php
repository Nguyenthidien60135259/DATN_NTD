<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function __construct(
        Color $color
    ) {
        $this->color = $color;
    }

    public function index()
    {
        //
        $color = $this->color->getAll();
        return response()->json(['data' => ["color" => $color]]);
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
        $data=[
            'code'=>$code,
            'name'=>$request->name,
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now()
        ];
        $this->color->addColor($data);

        return response()->json([
            "message" => "Đã tạo thành công"
        ]);
    }


    public function show($id)
    {
        $color = $this->color->getColorById($id);
        if ($color) {
            return response()->json(['data' => ["color" => $color]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        // dd($request->name);
        // exit();
        $color = $this->color->getColorById($id);
        if ($color) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:50',
                'code' => 'required|string'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()], 422);
            }
            $code = strtoupper($request->code);
            $data=[
                'code'=>$code,
                'name'=>$request->name,
                'created_at' =>Carbon::now()
            ];
            $this->color->updateColor($id,$data);
            
            return response()->json([
                'message' => "Cập nhật thành công!!",
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy"], 404);
        }
    }


    public function destroy($id)
    {
        $color = $this->color->getColorById($id);
        if ($color) {
            $this->color->deleteColor($id);
            return response()->json(['message' => 'Delete Successfully']);
        }
        return response()->json(["message" => "Không tìm thấy!!"]);
    }
}
