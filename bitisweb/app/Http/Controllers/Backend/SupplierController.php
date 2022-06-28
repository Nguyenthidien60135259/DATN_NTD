<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    
    public function listSupplier()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/supplier_list");
        $data = json_decode($response);
        $supplier = $data->data->supplier;
        // dd($data);
        return view("backend.supplier.list", compact('supplier'));
    }

    public function deleteSupplier(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/supplier_delete/" . $request->id);
        return redirect("/supplier_list");
    }

    public function createSupplier()
    {
        $this->AuthLogin();
        return view("backend.supplier.create");
    }

    public function saveCreateSupplier(Request $request)
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
        $response = Http::post("http://127.0.0.1:8001/api/supplier_create", [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect("/supplier_list");
    }

    public function updateSupplier(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/supplier_show/" . $id);
        $data = json_decode($response);
        $supplier = $data->data->supplier;
        // dd($supplier->name);
        return view("backend.supplier.update", compact('supplier'));
    }

    public function saveUpdateSupplier(Request $request)
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
        $response = Http::post("http://127.0.0.1:8001/api/supplier_update/" . $id, [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        // $data = json_decode($response);
        // dd($data,$id);
        return redirect("/supplier_list");
    }
}
