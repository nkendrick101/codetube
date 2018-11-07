<?php

return [
	'config' => [
		'ffmpeg_binary' => env('FFMPEG_BINARY'),
		'ffprobe_binary' => env('FFPROBE_BINARY'),
		'ffmpeg_threads' => env('FFMPEG_THREADS'),
		'timeout' => env('TIMEOUT'),
	]
];
