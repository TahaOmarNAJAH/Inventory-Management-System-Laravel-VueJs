<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
          'name' => $this->name,
          'code' => $this->code,
          'image' => $this->image,
          'selling_price' => $this->selling_price,
          'buying_price' => $this->buying_price,
          'buying_date' => $this->buying_date,
          'root' => $this->root,
          'product_quantity' => $this->product_quantity,
          'category_id' => $this->category_id,
          'supplier_id' => $this->supplier_id,
          'category_name' => $this->category->name,
          'supplier_name' => $this->supplier->name,

        ];
    }
}
