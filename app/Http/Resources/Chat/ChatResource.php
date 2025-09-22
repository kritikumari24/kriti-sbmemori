<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'user_first' => isset($this->user_first) ? $this->user_first : null,
            'user_second' => isset($this->user_second) ? $this->user_second : null,
            'is_file' => isset($this->is_file) ? $this->is_file : null,
            'last_message' => isset($this->last_message) ? $this->last_message : null,
            'user_first_image' => isset($this->user_first->image) ? $this->user_first->image : null,
            'user_second_image' => isset($this->user_second->image) ? $this->user_second->image : null,
            'created_at' => $this->created_at,
        ];
    }
}
