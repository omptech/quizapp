<?php

namespace App\Http\Resources\Player;

use Illuminate\Http\Resources\Json\Resource;

class PlayerCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
        'email'=>$this->email,
        'score'=>$this->score,
        'image'=>$this->image_url,
        'referral_code'=>$this->referral_code,
        'member_since'=>$this->created_at];
    }
}
