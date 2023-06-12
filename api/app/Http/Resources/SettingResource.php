<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class SettingResource extends JsonResource
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
            'user_id' => $this->user_id,
            'fiscal_code' => $this->fiscal_code,
            'vat' => $this->vat,
            'address' => $this->address,
            'city' => $this->city,
            'area' => $this->area,
            'region' => $this->region,
            'state' => $this->state,
            'phone' => $this->phone,
            'email' => $this->email,
            'post_code' => $this->post_code,
            'bank' => $this->bank,
            'iban' => $this->iban,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
