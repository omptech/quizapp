<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\Resource;

class SettingsCollection extends Resource
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
        'currency'=>$this->currency,
        'min_to_withdraw'=>$this->min_to_withdraw,
        'conversion_rate'=>$this->conversion_rate,
        'question_time'=>$this->question_time,
        'referral_register_points'=>$this->referral_register_points,
        'completed_option'=>$this->completed_option,
        'fifty_fifty'=>$this->fifty_fifty,
        'video_reward'=>$this->video_reward
    ];
    }
}
