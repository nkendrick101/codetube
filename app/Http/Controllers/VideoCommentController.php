<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Transformers\CommentTransformer;
use App\Http\Requests\CreateVideoCommentRequest;
use App\Http\Requests\UpdateVideoCommentRequest;

class VideoCommentController extends Controller
{
    public function index (Video $video) {        
        return response()->json(
            fractal()->collection($video->comments()->latestFirst()->get())
                ->parseIncludes(['channel', 'replies', 'replies.channel'])
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }

    public function create (CreateVideoCommentRequest $request, Video $video) {
        //$this->authorize('comment', $video);

        $comment = $video->comments()->create([
            'body' => $request->body,
            'reply_id' => $request->get('reply_id', null),
            'user_id' => $request->user()->id
        ]);

        return response()->json(
            fractal()->item($comment)
                ->parseIncludes(['channel', 'replies'])
                ->transformWith(new CommentTransformer)
                ->toArray()
        );
    }

    public function delete (Video $video, Comment $comment)
    {
        //$this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(null, 200);
    }
}
