<?php 

return [

    'buckets' => [
        'images' => env('GOOGLE_CLOUD_STORAGE_API_URI') . '/' . env('GOOGLE_CLOUD_STORAGE_IMAGES_BUCKET'),
        'videos' => env('GOOGLE_CLOUD_STORAGE_API_URI') . '/' . env('GOOGLE_CLOUD_STORAGE_VIDEOS_BUCKET'),
    ]

];