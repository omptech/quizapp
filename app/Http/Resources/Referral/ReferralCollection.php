<?php

namespace App\Http\Resources\Referral;
use App\Player;

use Illuminate\Http\Resources\Json\Resource;

class ReferralCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return 
        [
        'player_id'=>$this->player_id,
        'name'=>Player::find('id', '=', $this->li_m_refer_id)->name,
        'email'=>Player::find('id', '=', $this->li_m_refer_id)->email,
        'image_url'=>Player::find('id', '=', $this->li_m_refer_id)->image_url,
        'date'=>$this->created_at->format('jS F Y'),
    ];
    }
}
