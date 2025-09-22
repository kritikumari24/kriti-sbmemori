<?php

namespace App\Http\Resources\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessageResource extends JsonResource
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
            'sender_id' => isset($this->sender_id) ? $this->sender_id : null,
            'chat_id' => isset($this->chat_id) ? $this->chat_id : null,
            'message' => isset($this->message) ? $this->message : null,
            'is_file' => isset($this->is_file) ? $this->is_file : null,
            'created_at' => isset($this->̉created_at) ? get_default_format($this->created_at) : null,
        ];
    }
}
