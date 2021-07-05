<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
        ['question'=>$this->question,
        'trueAnswer'=>$this->true_answer,
        'falseAnswer1'=>$this->false_answer1,
        'falseAnswer2'=>$this->false_answer2,
        'falseAnswer3'=>$this->false_answer3,
        'points'=>$this->points,
        'created_at'=>$this->created_at,
        'category'=>$this->category_id,
        'level'=>$this->level];
    }
}
