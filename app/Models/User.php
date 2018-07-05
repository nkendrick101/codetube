<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Video;
use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function cards () {
        return $this->hasMany(Card::class);
    }

    public function channel () {
        return $this->hasMany(Channel::class);
    }

    public function videos () {
        return $this->hasManyThrough(Video::class, Channel::class);
    }

    public function subscriptions () {
        return $this->hasMany(Subscription::class);
    }

    public function subscribedChannels () {
        return $this->belongsToMany(Channel::class, 'subscriptions');
    }

    public function isSubscribedTo (Channel $channel) {
        return (bool) $this->subscriptions->where('channel_id', $channel->id)->count();
    }

    public function channelSlug () {
        return $this->channel()->first()->slug;
    }

    public function channelName () {
        return $this->channel()->first()->name;
    }

    public function channelImage () {
        return $this->channel()->first()->image;
    }

    public function channelDescription () {
        return $this->channel()->first()->description;
    }

    public function ownsChannel (Channel $channel) {
        return (bool) $this->channel->where('id', $channel->id)->count();
    }

    public function getPublicVideos () {
        return Channel::where('visibility', 'public')->get();
    }
}
