<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => isset($this->id) ? $this->id : null,
            'name' => isset($this->name) ? $this->name : null,
            'image' => isset($this->image) ? $this->image : null,
            'created_at' => isset($this->̉created_at) ? get_default_format($this->created_at) : null,
        ];
    }
}
