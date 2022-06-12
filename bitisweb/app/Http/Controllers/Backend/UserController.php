<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }

    public function listUser()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/user_list");
        $data = json_decode($response);
        $users = $data->data->users;
        return view("backend.user.list", compact('users'));
    }

    public function deleteUser(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/user_delete/" . $request->id);
        return redirect("/user_list");
    }

    public function detailUser(Request $request){
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/user_detail/". $request->id);
        $data = json_decode($response);
        $user = $data->data->user;
        return view("backend.user.detail",compact('user'));
    }
}
