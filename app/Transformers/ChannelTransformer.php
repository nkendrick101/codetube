<?php

namespace App\Transformers;

use App\Models\Channel;
use League\Fractal\TransformerAbstract;

class ChannelTransformer extends TransformerAbstract
{
    public function transform (Channel $channel) {
        return [
            'name' => $channel->user->name,
            'slug' => $channel->slug,
            'image' => $channel->image
        ];
    }
}