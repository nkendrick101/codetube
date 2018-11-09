<?php

namespace App\Jobs;

use File;
use Image;
use FFMpeg;
use Storage;
use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranscodeVideo implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $filename;

  public function __construct ($filename) {
    $this->filename = $filename;
  }

  public function handle () {        
    $ffmpeg = FFMpeg\FFMpeg::create([
      'ffmpeg.binaries' => config('ffmpeg.config.ffmpeg_binary'),
      'ffprobe.binaries' => config('ffmpeg.config.ffprobe_binary'),
      'ffmpeg.threads' => config('ffmpeg.config.ffmpeg_threads'),
      'timeout' => config('ffmpeg.config.timeout'),
    ]);

    $media = $ffmpeg->open(public_path('uploads') . '/' . $this->filename);
    $my_video = Video::where('video_filename', $this->filename)->firstOrFail();
    $format = new FFMpeg\Format\Video\WebM();

    /*$format->on('progress', function ($video, $format, $percentage) use ($my_video) {
      $my_video->processed_percentage = $percentage;
      $my_video->save();
    });

    $video_id = uniqid(true);
    $media->save($format, public_path('uploads') . '/' . $video_id . '.webm');
    $media->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(12))->save(public_path('uploads') . '/' . $video_id . '.jpg');

    // Resize thumbnail
    Image::make(public_path('uploads') . '/' . $video_id . '.jpg')->fit(1280, 600, function($c) { $c->upsize(); })->save();

    // Push video and thumbnail into the cloud
    Storage::disk('gcs_videos')->put($video_id . '.webm', file_get_contents(public_path('uploads') . '/' . $video_id . '.webm'), 'public');
    Storage::disk('gcs_videos')->put($video_id . '.jpg', file_get_contents(public_path('uploads') . '/' . $video_id . '.jpg'), 'public');

    // Apply local delete subsquently
    File::delete(public_path('uploads') . '/' . $this->filename);
    File::delete(public_path('uploads') . '/' . $video_id . '.webm');
    File::delete(public_path('uploads') . '/' . $video_id . '.jpg');

    // Record transcoding proccess
    $my_video->video_id = $video_id;
    $my_video->processed = true;
    $my_video->save();*/
  }
}
