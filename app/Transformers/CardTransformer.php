<?php

namespace App\Transformers;

use App\Models\Card;
use League\Fractal\TransformerAbstract;

class CardTransformer extends TransformerAbstract
{
    public function transform(Card $card)
    {
        return [
            'id' => $card->token,
            'holder' => $card->holder,
            'last4' => $card->last4,
            'type' => $card->type,
            'image' => $card->image,
            'created_at' => $card->created_at->diffForHumans(),
            'updated_at' => $card->created_at->diffForHumans(),
        ];
    }
}
