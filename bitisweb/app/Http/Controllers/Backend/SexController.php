<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SexController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    public function listSex()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/sex_list");
        $data = json_decode($response);
        $sex = $data->data->sex;
        // dd($data);
        return view("backend.sex.list", compact('sex'));
    }

    public function deleteSex(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/sex_delete/" . $request->id);
        return redirect("/sex_list");
    }

    public function createSex()
    {
        $this->AuthLogin();
        return view("backend.sex.create");
    }

    public function saveCreateSex(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/sex_create", [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect("/sex_list");
    }

    public function updateSex(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/sex_show/" . $id);
        $data = json_decode($response);
        $sex = $data->data->sex;
        // dd($sex->name);
        return view("backend.sex.update", compact('sex'));
    }

    public function saveUpdateSex(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::post("http://127.0.0.1:8001/api/sex_update/" . $id, [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        // $data = json_decode($response);
        // dd($data,$id);
        return redirect("/sex_list");
    }
}
