<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    public function getSizeByName($key){
        $result = DB::table('sizes')->where('name', '=', $key)->get();
        return $result;
    }
    public function getSizeById($id){
        $result = DB::table('sizes')->where('id', '=', $id)->first();
        return $result;
    }
    public function getAll(){
        $result = DB::table('sizes')->get();
        return $result;
    }
    public function addSize($data){
        DB::table('sizes')->insert($data);
    }
    public function updateSize($id,$data){
        DB::table('sizes')->where('id','=',$id)->update($data);
    }
    public function deleteSize($id){
        DB::table('sizes')->where('id','=',$id)->delete();
    }
}
