<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    public function getAll()
    {
        $result = DB::table('categorys')->get();
        return $result;
    }
    public function getCategoryById($id)
    {
        $result = DB::table('categorys')
        ->where('id', '=', $id)->first();
        return $result;
    }
    public function addCategory($data){
        DB::table('categorys')->insert($data);
    }
    public function updateCategory($id,$data){
        DB::table('categorys')->where('id',$id)->update($data);
    }
    public function deleteCategory($id){
        DB::table('categorys')->where('id',$id)->delete();
    }
}
