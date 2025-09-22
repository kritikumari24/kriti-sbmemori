<?php

namespace App\Http\Collections\Chat;

use App\Http\Resources\Chat\ChatMessageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatMessageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => ChatMessageResource::collection($this->collection),
            // 'pagination' => [
            //     'total' => $this->total(),
            //     'count' => $this->count(),
                // 'per_page' => $this->perPage(),
                // 'current_page' => $this->currentPage(),
                // 'last_page' => $this->lastPage(),
            // ],
        ];
    }
}
