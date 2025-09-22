<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => isset($this->id) ? $this->id : null,
            'customer_id' => isset($this->customer_id) ? $this->customer_id : null,
            'vendor_id' => isset($this->vendor_id) ? $this->vendor_id : null,
            'is_file' => isset($this->is_file) ? $this->is_file : null,
            'last_message' => isset($this->last_message) ? $this->last_message : null,
            'created_at' => $this->created_at,
        ];
    }
}
