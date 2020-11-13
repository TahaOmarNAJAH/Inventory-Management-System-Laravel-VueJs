<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer->name,
            'paid' => $this->pay,
            'due' => $this->due,
            'total' => $this->total,
            'pay_by' => $this->pay_by,
            'date' => $this->date,
        ];
    }
}
