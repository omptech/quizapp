<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['currency','min_to_withdraw','conversion_rate','question_time','referral_register_points', 'completed_option', 'fifty_fifty', 'video_reward'];
}
