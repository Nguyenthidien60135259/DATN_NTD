<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role_id',
    ];
    protected $table = 'users';
    protected $primaryKey = 'id';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'role_id',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles()
    {
        $this->belongsTo('App\Models\Roles', '_idrole', 'id');
    }

    public function getUserId($id)
    {
        $result = DB::table('users')->where('id', '=', $id)->get();
    }

    // public function update($userId,$data){
    //     DB::table('users')->where('id', $userId)->update($data);

    // }

    public function getAll()
    {
        $result = DB::table('users')->get();
        return $result;
    }
    public function getUserById($id){
        $result = DB::table('users')->where('id',$id)->first();
        return $result;
    }

    public function deleteUser($id){
        DB::table('users')->where('id',$id)->delete();
    }
}
