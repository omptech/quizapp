<?php

namespace App\Http\Resources\Ads;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
        'native_app_id'=>$this->native_app_id,
        'interstitial_app_id'=>$this->interstitial_app_id,
        'banner_app_id'=>$this->banner_app_id,
        'rewarded_video_app_id'=>$this->rewarded_video_app_id,
        'facebook_banner_id'=>$this->facebook_banner_id,
        'facebook_native_id'=>$this->facebook_native_id,
    ];
    }
}
