<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct(
        Admin $admin
    ) {
        $this->admin = $admin;
        $this->middleware('auth:admin');
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()]);
        }
        $email = $request->email;
        $admin = $this->admin->getAdminByEmail($email);
        if (!$admin == NULL && $admin->password == $request->password) {
            return response()->json([
                "message" => "Đăng nhập thành công",
                "admin" => $admin
            ]);
        } 
        else {
            return response()->json([
                "message" => "Đăng nhập không thành công sai email hoặc mật khẩu"
            ]);
        }
    }

    public function logout(Request $request)
    {
        if ($request->admin()) {
            $request->admin()->tokens()->delete();
        }

        return response()->json(['message' => 'Đăng xuất thành công!!'], 200);
    }

    public function profile($id, Request $request){
        $admin = $this->admin->getAdminById($id);
        return response()->json(['data'=>['admin'=>$admin]]);
    }
}
