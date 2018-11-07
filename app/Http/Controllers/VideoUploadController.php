<?php

namespace App\Http\Controllers;

use App\Jobs\TranscodeVideo;
use Illuminate\Http\Request;
use App\Http\Requests\VideoUploadRequest;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class VideoUploadController extends Controller
{
  public function store (VideoUploadRequest $request) {
    $receiver = new FileReceiver('video', $request, HandlerFactory::classFromRequest($request));

    if ($receiver->isUploaded() === false) {
      throw new UploadMissingFileException();
    }

    $saver = $receiver->receive();

    if ($saver->isFinished()) {
      $channel = $request->user()->channel()->first();
      $video_model = $channel->videos()->where('uuid', $request->uuid)->firstOrFail();
      $video_file = $saver->getFile();
      $video_file->move(public_path('files') . '/', $video_model->video_filename);
      $this->dispatch(new TranscodeVideo($video_model->video_filename));
    }

    $handler = $saver->handler();

    return response()->json([
      'done' => $handler->getPercentageDone(),
      'status' => true
    ]);
  }
}
