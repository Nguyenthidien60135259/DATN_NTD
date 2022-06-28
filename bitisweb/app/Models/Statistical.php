<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Statistical extends Model
{
    use HasFactory;
    protected $table = 'statisticals';

    public function getStatisByOrderDate($order_date){
     $statis = DB::table('statisticals')->where("order_date", $order_date)->get();
     return $statis;
    }

    public function addStatistical($data){
        DB::table('statisticals')->insert($data);
    }
    public function updateStatistical($id,$data){
        DB::table('statisticals')->where('id','=',$id)->update($data);
    }
}
