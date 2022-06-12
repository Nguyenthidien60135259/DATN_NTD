<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guard = 'admin';
    protected $table='admins';
    public function getAdminByEmail($email)
    {
        $result = DB::table('admins')
        ->where('email', 'like', $email)->first();
        return $result;
    }
    public function getAdminById($id){
        $result = DB::table('admins')
        ->where('id',$id)->first();
        return $result;
    }
}
