<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;

session_start();

class AdminController extends Controller
{
    public function __construct(
        Admin $admin
    ) {
        $this->admin = $admin;
        // $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }

    public function dashboard()
    {
        $this->AuthLogin();
        return view("backend.layout.index");
    }

    public function login()
    {
        return view("backend.auth.login");
    }


    function postLogin(Request $request)
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
            Session::put('name', $admin->name);
            Session::put('id', $admin->id);
            return Redirect::to("admin/dashboard");
        } else {
            Session::put('message', "Đăng nhập không thành công sai email hoặc mật khẩu");
            return redirect('/admin')->with("Đăng nhập không thành công sai email hoặc mật khẩu");;
        }
    }

    function logout(Request $request)
    {
        // $request->session()->flush();
        Session::put('name', null);
        Session::put('id', null);
        return redirect("/login");
    }
}
