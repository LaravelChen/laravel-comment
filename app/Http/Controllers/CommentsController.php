<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

class CommentsController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Post $post)
    {
        if (request('parent_id')) {
            $real_comment = Comment::findOrFail(request('parent_id'));
            $level = $real_comment->level + 1;
            if ($level >= 3) {
                $level = 3;
            }
        }
        $comment = $post->comments()->create([
            'body' => request('body'),
            'user_id' => \Auth::id(),
            'level' => $level ?? 0,
            'parent_id' => request('parent_id', null),
        ]);
        $comment = Comment::with('owner')->find($comment->id);
        return response()->json([
            'success' => true,
            'reply_block' => $comment,
        ]);
    }
}
