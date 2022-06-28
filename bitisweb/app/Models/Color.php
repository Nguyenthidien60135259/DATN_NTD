<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    public function getProductByColorId($key)
    {
        $result = DB::table('colors')->where('image','Like',"%$key%")->select('id')->get();
        return $result;
    }

    public function getColorById($id){
        $result = DB::table('colors')
        ->where('id','=',$id)->first();
        return $result;
    }

    public function getAll(){
        $result = DB::table('colors')->get();
        return $result;
    }

    public function addColor($data){
        DB::table('colors')->insert($data);
    }

    public function updateColor($id,$data){
        DB::table('colors')->where('id',$id)->update($data);
    }

    public function deleteColor($id){
        DB::table('colors')->where('id',$id)->delete();
    }
}
