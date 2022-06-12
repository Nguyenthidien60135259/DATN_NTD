<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->getAll();
        return response()->json(['data' => ["users" => $users]]);
    }

    public function show($id)
    {
        $user = $this->user->getUserById($id);
        if ($user) {
            return response()->json(['data' => ["user" => $user]]);
        } else {
            return response()->json(['messge' => "Không tìm thấy!!"]);
        }
    }


    public function destroy($id)
    {
        $user = $this->user->getUserById($id);
        if ($user) {
            $this->user->deleteUser($id);
            return response()->json(["message" => "Xóa thành công!"]);
        } else {
            return response()->json(["message" => "Không tìm thấy!"]);
        }
    }
}
