<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admob extends Model
{
	protected $fillable = ['admob_native', 'admob_banner', 'admob_video', 'admob_interstitial', 'fb_native', 'fb_banner', 'fb_interstitial', 'bottom_banner_type'];
}
