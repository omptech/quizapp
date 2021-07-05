<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Category extends Model
{
    protected $fillable = ['name', 'image_url', 'is_featured'];
    public function questions() {
    	return $this->hasMany(Question::class);
    }
}
