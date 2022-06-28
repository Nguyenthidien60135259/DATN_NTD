<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }

    public function listSize()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/size_list");
        $data = json_decode($response);
        $size = $data->data->size;
        return view("backend.size.list", compact('size'));
    }

    public function deleteSize(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/size_delete/" . $request->id);
        return redirect("/size_list");
    }

    public function createSize()
    {
        $this->AuthLogin();
        return view("backend.size.create");
    }

    public function saveCreateSize(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'size' => 'required|interger'
        ]);

        // check validator ?
        if ($validator->fails()) {
            return back()->with('message', $validator->errors());
        }
        $response = Http::post("http://127.0.0.1:8001/api/size_create", [
            'size' => $request->name,
        ]);
        return redirect("/size_list");
    }

    public function updateSize(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/size_show/" . $id);
        $data = json_decode($response);
        $size = $data->data->size;
        // dd($data);
        return view("backend.size.update", compact('size'));
    }

    public function saveUpdateSize(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'size' => 'required|interger'
        ]);

        // check validator ?
        if ($validator->fails()) {
            return back()->with('message', $validator->errors());;
        }
        $response = Http::post("http://127.0.0.1:8001/api/size_update/" . $request->id, [
            'size' => $request->size,
        ]);
        // $data = json_decode($response);
        // dd($request->id,$data);
        return redirect("/size_list");
    }
}
