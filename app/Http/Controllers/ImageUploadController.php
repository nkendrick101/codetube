<?php

namespace App\Http\Controllers;

use File;
use Image;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class ImageUploadController extends Controller
{
    public function store (Request $request) {
    	$receiver = new FileReceiver('image', $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        $saver = $receiver->receive();

        if ($saver->isFinished()) {
            $channel = $request->user()->channel()->first();
            $image = $saver->getFile();
            $filename = $channel->slug . '.' . $image->getClientOriginalExtension();

            $image->move(public_path() . '/uploads', $filename);            
        	Image::make(public_path() . '/uploads/' . $filename)->fit(150, 150, function ($c) { $c->upsize(); })->save();
        	Storage::disk('gcs_images')->put($filename, file_get_contents(public_path() . '/uploads/' . $filename), 'public');
        	File::delete(public_path() . '/uploads/' . $filename);

        	$img_url = Storage::disk('gcs_images')->url($filename);
            $channel->image = $img_url;
            $channel->save();

            return response()->json(['url' => $img_url, 'status' => 'Profile image updated.'], 200);
        }

        $handler = $saver->handler();

        return response()->json(['done' => $handler->getPercentageDone(), 'status' => true]);
    }
}
