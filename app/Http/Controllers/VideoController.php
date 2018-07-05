<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\VideoCreateRequest;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{
    public function index (Request $request) {
        $videos = $request->user()->videos()->latestFirst()->paginate(3);

        return view ('videos.index', [
            'videos' => $videos
        ]);
    }

    public function show (Request $request, Video $video) {
        return view('videos.show', [
            'video' => $video,
            'user' => $request->user(),
            'channel' => $video->channel
        ]);
    }

    public function edit (Video $video) {
        //$this->authorize('edit', $video);

        return view('videos.edit', [
            'video' => $video
        ]);
    }

    public function store (VideoCreateRequest $request) {
        $uuid = uniqid(true);

        $channel = $request->user()->channel()->first();

        $video = $channel->videos()->create([
            'uuid' => $uuid,
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'video_filename' => "{$uuid}.{$request->extension}",
            'allow_votes' => 1,
            'allow_comments' => 1
        ]);


        return response()->json([
            'uuid' => $uuid,
        ]);
    }

    public function update (VideoUpdateRequest $request, Video $video) {
        //$this->authorize('update', $video);
        
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'visibility' => $request->visibility,
            'allow_votes' => $request->has('allow_votes'),
            'allow_comments' => $request->has('allow_comments')
        ]);


        if ($request->ajax()) {
            return response()->json(null, 200);
        }

        return redirect()->back()->with('status', 'Video updated.');
    }

    public function delete(Request $request, Video $video) {
        //$this->authorize('delete', $video);
        $video->delete();
        return ($request->ajax()) ? response()->json(null, 200) : redirect()->back();
    }
}