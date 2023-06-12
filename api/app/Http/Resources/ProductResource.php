<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'code' => $this->code,
            'brand' => $this->brand,
            'model' => $this->model,
            'size' => $this->size,
            'name' => $this->name,
            'category_id' => $this->category,
            'subcategory_id' => $this->subcategory,
            'colour' => $this->colour,
            'description' => $this->description,
            'note' => $this->note,
            'price_id' => $this->price
        ];
    }
}
