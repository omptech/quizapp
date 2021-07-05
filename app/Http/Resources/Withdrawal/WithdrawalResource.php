<?php

namespace App\Http\Resources\Withdrawal;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource
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
        [
        'user_id'=>$this->player_id,
        'amount'=>$this->amount,
        'points'=>$this->points,
        'status'=>$this->status,
        'method'=>$this->payment_method,
        'account'=>$this->payment_account,
        'date'=>$this->created_at->format('jS F Y')
    ];
    }
}
