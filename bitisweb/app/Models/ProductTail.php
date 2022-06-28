<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTail extends Model
{
    use HasFactory;
    protected $table = 'product_tails';
    public function getAll(){
        $result = DB::table('product_tails')->get();
        return $result;
    }

    public function getProTailById($id){
        $result = DB::table('product_tails')->where('id',$id)->first();
        return $result;
    }

    public function addProTail($data){
        DB::table('product_tails')->insert($data);
    }

    public function updateProTail($id,$data){
        DB::table('product_tails')->where('id',$id)->update($data);
    }

    public function deleteProTail($id){
        DB::table('product_tails')->where('id',$id)->delete();
    }
}
