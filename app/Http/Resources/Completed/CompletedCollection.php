<?php

namespace App\Http\Resources\Completed;
use App\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompletedCollection extends ResourceCollection
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
        'category'=>Category::find($this->category_id)->name;
        'level'=>$this->category_level,
        'earned_points'=>$this->points,
        'total_points'=>$this->total_quiz_points,
        'date'=>$this->created_at->format('jS F Y')
    ];
    }
}
