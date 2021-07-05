<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Player;

class Withdrawal extends Model
{
    protected $fillable = ['player_id', 'amount', 'points', 'status', 'payment_method', 'payment_account'];

    public function player() {
    	return $this->belongsTo(Player::class);
    }

}
