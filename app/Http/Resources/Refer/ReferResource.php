<?php

namespace App\Http\Resources\Refer;
use App\Player;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
        'player_id'=>$this->player_id,
        'name'=>Player::find($this->li_m_refer_id)->name,
        'email'=>Player::find($this->li_m_refer_id)->email,
        'image_url'=>Player::find($this->li_m_refer_id)->image_url,
        'date'=>$this->created_at->format('jS F Y'),
    ];
    }
}
