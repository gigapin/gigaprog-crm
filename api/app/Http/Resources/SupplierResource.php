<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'company' => $this->company,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'name_manager' => $this->name_manager,
            'name_manager_store' => $this->name_manager_store,
            'address_store' => $this->address_store,
            'phone_store' => $this->phone_store,
            'post_code_store' => $this->post_code_store,
            'email_2' => $this->email_2,
            'phone_2' => $this->phone_2,
            'setting_id' => $this->setting
        ];
    }
}
