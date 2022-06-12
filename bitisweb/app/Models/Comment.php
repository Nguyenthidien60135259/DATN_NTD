<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    public function getCommenyByProductId($product_id){
        $result = DB::table('comments')->where('product_id','=',$product_id)->get();
        return $result;
    }

    public function getAll(){
        $result = DB::table('comments')->get();
        return $result;
    }
    
    public function getCommentById($id){
        $result = DB::table('comments')->where('id',$id)->first();
        return $result;
    }

    public function deleteComment($id){
        DB::table('comments')->where('id',$id)->delete();
    }
}
