<?php

namespace App;
use App\Completed;
use App\Refer;
use App\Withdrawal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Player extends Model
{
    use Notifiable;
    // Make columns fillable
    protected $fillable = ['name', 'email', 'password', 'score', 'image_url', 'referral_code'];

    public function withdrawals() {
    	return $this->hasMany(Withdrawal::class)->orderBy('id', 'desc');
    }

    public function completeds() {
    	return $this->hasMany(Completed::class)->orderBy('id', 'desc');
    }

    public function refers() {
    	return $this->hasMany(Refer::class)->orderBy('id', 'desc');
    }

}
