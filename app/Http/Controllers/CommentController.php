<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'medical_record_id' => $request->medical_record_id,
            'comment' => $request->comment,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully.',
            'comment' => $comment,
        ]);
    }
}
