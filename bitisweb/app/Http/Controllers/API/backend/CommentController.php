<?php

namespace App\Http\Controllers\API\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;

class CommentController extends Controller
{
    public function __construct(
        Comment $comment,
        Product $product,
        User $user
    ) {
        $this->comment = $comment;
        $this->product = $product;
        $this->user = $user;
    }

    public function index()
    {
        $comment = $this->comment->getAll();
        $product = $this->product->getAll();
        $user = $this->user->getAll();
        return response()->json([
           'data'=>[
               'comment'=>$comment,
               'product'=>$product,
               'user'=>$user
           ]
        ]);
    }

    
    public function destroy($id)
    {
        $comment = $this->comment->getCommentById($id);
        if($comment){
            
            $this->comment->deleteComment($id);
            return response()->json(['message'=>"Xóa thành công!"]);
        }
        return response()->json(['message'=>"Không tìm thấy!!"]);
    }
}
