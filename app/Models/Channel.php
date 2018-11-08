<?php

namespace App\Models;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoViews;
use App\Models\Subscription;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
  use Searchable;

  protected $fillable = [
    'name',
    'slug',
    'visibility',
    'description',
    'image'
  ];

  public function user () {
    return $this->belongsTo(User::class);
  }

  public function videos () {
    return $this->hasMany(Video::class);
  }

  public function getRouteKeyName () {
    return 'slug';
  }

  public function getImage () {
    if (!$this->image_filename) {
      return config('codetube.buckets.images') . '/channel_default.png';
    }

    return config('codetube.buckets.images') . '/' . $this->image_filename;
  }

  public function subscriptions () {
    return $this->hasMany(Subscription::class);
  }

  public function subscriptionCount () {
    return $this->subscriptions->count();
  }

  public function totalVideoViews () {
    return $this->hasManyThrough(VideoView::class, Video::class)->count();
  }

  public function isVisible ($id) {
    return $this->user_id === $id || $this->visibility === 'public' ? true : false;
  }
}
