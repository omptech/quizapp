<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\Resource;

class CategoryCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function toArray($request)
    {
        return ['id'=>$this->id,
        'name'=>$this->name,
        'imageUrl'=>$this->image_url,
        'Featured'=>$this->is_featured,
        'created_at'=>$this->created_at];
    }
}
