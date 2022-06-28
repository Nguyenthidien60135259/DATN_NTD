<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
 	protected $table = 'images';
    //  protected $fillable = [
    //     'product_id','image'
    // ];

    public function getImageByProductId($key){
        $result = DB::table('images')
        ->where('product_id', '=', $key)->get();
        return $result;
    }

    public function getAllImage(){
        $result = DB::table('images')->get();
        return $result;
    }

    public function addImage($data_image)
    {
        DB::table('images')->insert($data_image);
    }

    public function deleteImage($id)
    {
        DB::table('images')->where('product_id', $id)->delete();
    }
    
    // public function update($id,$data){
    //     DB::table('images')->where('id','=',$id)->update($data);
    // }
}
