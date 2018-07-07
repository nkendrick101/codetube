<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Vote;
use App\Models\User;
use App\Models\Channel;
use App\Models\Comment;
use App\Traits\Orderable;
use App\Models\VideoViews;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use Orderable;
    use Searchable;
    use SoftDeletes; 
    use SearchableTrait;

    protected $fillable = [
        'title',
        'description',
        'uuid',
        'video_filename',
        'video_id',
        'processed',
        'visibility', 
        'allow_votes',
        'allow_comments',
        'processed_percentage',
    ];

    protected $searchable = [
        'columns' => [
            'videos.title' => 10,
            'videos.visibility' => 10,
        ],
    ];

    public function toSearchableArray () {
        $properties = $this->toArray();
        $properties['visible'] = $this->isProcessed() && $this->isPublic();
        return $properties;
    }
    
    public function channel () {
        return $this->belongsTo(Channel::class);
    }

    public function getRouteKeyName () {
        return 'uuid';
    }

    public function getThumbnail () {
        if (!$this->processed) {
            return config('codetube.buckets.images') . '/video_default.png';
        }

        return config('codetube.buckets.videos') . '/' .$this->video_id . '.jpg';
    }

    public function votesAllowed () {
        return (bool) $this->allow_votes;
    }

    public function commentsAllowed () {
        return (bool) $this->allow_comments;
    }

    public function isPrivate () {
        return $this->visibility === 'private';
    }

    public function isPublic () {
        return $this->visibility === 'public';
    }

    public function isProcessed () {
        return (bool) $this->processed;
    }

    public function ownedByUser (User $user) {
        return $this->channel->user->id === $user->id;
    }

    public function canBeAccessed (User $user = null) {
        if (!$user && $this->isPrivate()) {
            return false;
        }

        if ($user && $this->isPrivate() && !$this->ownedByUser($user)) {
            return false;
        }

        return true;
    }

    public function getStreamUrl () {
        return config('codetube.buckets.videos') . '/' . $this->video_id . '.webm';
    }

    public function views () {
        return $this->hasMany(VideoView::class);
    }

    public function viewCount () {
        return $this->views->count();
    }

    public function votes () {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function upVotes () {
        return $this->votes->where('type', 'up');
    }

    public function downVotes () {
        return $this->votes->where('type', 'down');
    }

    public function voteFromUser (User $user) {
        return $this->votes->where('user_id', $user->id);
    }

    public function comments () {
        return $this->morphMany(Comment::class, 'commentable')->where('reply_id', null);
    }

    public function scopeProcessed ($query) {
        return $query->where('processed', true);
    }

    public function scopePublic ($query) {
        return $query->where('visibility', 'public');
    }

    public function scopeVisible ($query) {
        return $query->processed()->public();
    }

    public function posted_at () {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('F j, Y');
    }
}
