<?php

namespace App\Http\Resources\Payments;

use Illuminate\Http\Resources\Json\Resource;

class PaymentsCollection extends Resource
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
            'method'=>$this->method,
        ];
}
}