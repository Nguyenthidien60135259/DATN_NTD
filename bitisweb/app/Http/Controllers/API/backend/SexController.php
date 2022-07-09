<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Sex;

class SexController extends Controller
{
    public function __construct(
        Sex $sex
    ) {
        $this->sex = $sex;
    }

    public function index()
    {
        //
        $sex = $this->sex->getAll();
        return response()->json(['data' => ["sex" => $sex]]);
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
        $this->sex->addSex($data);

        return response()->json([
            "message" => "Đã tạo thành công"
        ]);
    }


    public function show($id)
    {
        $sex = $this->sex->getSexById($id);
        if ($sex) {
            return response()->json(['data' => ["sex" => $sex]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function update(Request $request, $id)
    {
        // dd($request->name);
        // exit();
        $sex = $this->sex->getSexById($id);
        if ($sex) {
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
            $this->sex->updateSex($id,$data);
            
            return response()->json([
                'message' => "Cập nhật thành công!!",
            ]);
        } else {
            return response()->json(["message" => "Không tìm thấy"], 404);
        }
    }


    public function destroy($id)
    {
        $sex = $this->sex->getSexById($id);
        if ($sex) {
            $this->sex->deleteSex($id);
            return response()->json(['message' => 'Delete Successfully']);
        }
        return response()->json(["message" => "Không tìm thấy!!"]);
    }
}
