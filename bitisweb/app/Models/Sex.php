<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sex extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $primaryKey = 'id';
 	protected $table = 'sexs';

     public function getSex($name){
        $result = DB::table('sexs')->where('name','=',$name)->get();
        return $result;
     }
    public function getAll(){
        $result = DB::table('sexs')->get();
        return $result;
    }
    public function getSexById($id){
        $result = DB::table('sexs')->where('id','=',$id)->first();
        return $result;
    }
    public function addSex($data){
        DB::table('sexs')->insert($data);
    }
    public function updateSex($id,$data){
        DB::table('sexs')->where('id','=',$id)->update($data);
    }
    public function deleteSex($id){
        DB::table('sexs')->where('id','=',$id)->delete();
    }
}
