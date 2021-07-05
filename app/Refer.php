<?php

namespace App;
use App\Player;

use Illuminate\Database\Eloquent\Model;

class Refer extends Model
{
    protected $fillable = ['player_id', 'li_m_refer_email', 'li_m_refer_id'];

    public function player() {
    	return $this->belongsTo(Player::class);
    }
}
