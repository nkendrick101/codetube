<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
  public function search (Request $request) {
    $query = $request->input('search_query');

    $videos = Video::search($query, null, true, true)
      ->paginate(15)
      ->appends(Input::except(['page', 'search_query']));

    return view ('search_results', [
      'query' => $query,
      'videos' => $videos
    ]);
  }
}
