<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    public function getAll(){
        $result = DB::table('suppliers')->get();
        return $result;
    }

    public function getSupplierById($id){
        $result = DB::table('suppliers')->where('id','=',$id)->first();
        return $result;
    }

    public function addSupplier($data){
        DB::table('suppliers')->insert($data);
    }

    public function updateSupplier($id,$data){
        DB::table('suppliers')->where('id','=',$id)->update($data);
    }

    public function deleteSupplier($id){
        DB::table('suppliers')->where('id','=',$id)->delete();
    }
}
