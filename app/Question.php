<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Question extends Model
{
    protected $fillable = ['question', 'true_answer', 'false_answer1', 'false_answer2', 'false_answer3', 'level', 'category_id', 'points'];
    
    public function category() {
    	return $this->belongsTo(Category::class);
    }
}
