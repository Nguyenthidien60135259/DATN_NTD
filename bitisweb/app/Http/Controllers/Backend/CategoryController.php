<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');
        if ($admin_id) {
            return Redirect::to('/admin/dashboard');
        } else
            return Redirect::to('/admin')->send();
    }
    public function listCategory()
    {
        $this->AuthLogin();
        $response = Http::get("http://127.0.0.1:8001/api/category_list");
        $data = json_decode($response);
        $category = $data->data->category;
        return view("backend.category.list", compact('category'));
    }

    public function deleteCategory(Request $request)
    {
        $this->AuthLogin();
        $response = Http::post("http://127.0.0.1:8001/api/category_delete/" . $request->id);
        return redirect("/category_list");
    }

    public function createCategory()
    {
        $this->AuthLogin();
        return view("backend.category.create");
    }

    public function saveCreateCategory(Request $request)
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
        $response = Http::post("http://127.0.0.1:8001/api/category_create", [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        return redirect("/category_list");
    }

    public function updateCategory(Request $request)
    {
        $this->AuthLogin();
        $id = $request->id;
        $response = Http::get("http://127.0.0.1:8001/api/category_show/" . $id);
        $data = json_decode($response);
        $category = $data->data->category;
        // dd($category->name);
        return view("backend.category.update", compact('category'));
    }

    public function saveUpdateCategory(Request $request)
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
        $response = Http::post("http://127.0.0.1:8001/api/category_update/" . $id, [
            'code' => $request->code,
            'name' => $request->name,
        ]);
        // $data = json_decode($response);
        // dd($data,$id);
        return redirect("/category_list");
    }
}
