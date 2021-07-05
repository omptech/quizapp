<?php

namespace App\Http\Resources\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
        'currency'=>$this->question,
        'min_points_to_withdraw'=>$this->true_answer,
        'conversion_rate'=>$this->false_answer1,
        'question_time'=>$this->false_answer2,
        'referral_register_points'=>$this->false_answer3,
        'completed_option'=>$this->completed_option,
        'fifty_fifty'=>$this->fifty_fifty,
        'video_reward'=>$this->video_reward
    ];
    }
}
