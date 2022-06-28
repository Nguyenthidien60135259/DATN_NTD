<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    public function listColor()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/color_list");
        $data = json_decode($response);
        $color = $data->data->color;
        // dd($data);
        return view("backend.color.list", compact('color'));
    }

    public function deleteColor(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/color_delete/" . $request->id);
        return redirect("/color_list");
    }

    public function createColor()
    {
        $this->AuthLogin();
        return view("backend.color.create");
    }

    public function saveCreateColor(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string'
        ]);
    
        // check validator ?
        if ($validator->fails()) {
            return back()->with('message', $validator->errors());;
        }
        $response = Http::post("http://127.0.0.1:8001/api/color_create", [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect("/color_list");
    }

    public function updateColor(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/color_show/" . $id);
        $data = json_decode($response);
        $color = $data->data->color;
        // dd($color->name);
        return view("backend.color.update", compact('color'));
    }

    public function saveUpdateColor(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string'
        ]);
    
        // check validator ?
        if ($validator->fails()) {
            return back()->with('message', $validator->errors());;
        }
        $id = $request->id;
        $response = Http::post("http://127.0.0.1:8001/api/color_update/" . $id, [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        // $data = json_decode($response);
        // dd($data,$id);
        return redirect("/color_list");
    }
}
