<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    public function getAll(){
        $result = DB::table('orders')->get();
        return $result;
    }
    public function getOrderById($id){
        $result = DB::table('orders')
        ->where('id',$id)->first();
        return $result;
    }
}
