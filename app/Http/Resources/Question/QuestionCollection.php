<?php

namespace App\Http\Resources\Question;
use App\Category;

use Illuminate\Http\Resources\Json\Resource;

class QuestionCollection extends Resource
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
        'question'=>$this->question,
        'trueAnswer'=>$this->true_answer,
        'falseAnswer1'=>$this->false_answer1,
        'falseAnswer2'=>$this->false_answer2,
        'falseAnswer3'=>$this->false_answer3,
        'points'=>$this->points,
        'created_at'=>$this->created_at,
        'category'=> Category::find($this->category_id)->name,
        'level'=>$this->level];
    }
}
