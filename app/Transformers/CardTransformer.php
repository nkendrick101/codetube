<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class CardTransformer extends TransformerAbstract
{
  public function transform($card) {
    return [
      'id' => $card->token,
      'holder' => $card->cardholderName,
      'last4' => $card->last4,
      'type' => $card->cardType,
      'image' => $card->imageUrl
    ];
  }
}
