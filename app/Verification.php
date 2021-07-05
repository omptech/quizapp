<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Verification extends Model
{
	use Notifiable;
    protected $fillable = ['email', 'account_verification_code', 'pw_reset_code'];
}
