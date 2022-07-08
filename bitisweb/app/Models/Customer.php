<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    public function getAll(){
        $result = DB::table('customers')->get();
        return $result;
    }

    public function getCusById($id){
        $result = DB::table('customers')
        ->where('id',$id)->first();
        return $result;
    }

    public function updateCus($id, $data)
    {
        DB::table('customers')->where('id', '=', $id)->update($data);
    }

}
