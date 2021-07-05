<?php

namespace App\Http\Resources\Admob;

use Illuminate\Http\Resources\Json\JsonResource;

class AdmobResource extends JsonResource
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
        'admob_native'=>$this->admob_native,
        'admob_interstitial'=>$this->admob_interstitial,
        'admob_banner'=>$this->admob_banner,
        'admob_video'=>$this->admob_video,
        'fb_banner'=>$this->fb_banner,
        'fb_native'=>$this->fb_native,
        'fb_interstitial'=>$this->fb_interstitial,
        'bottom_banner_type'=>$this->bottom_banner_type
    ];
    }
}
