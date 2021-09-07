<?php

namespace App\Http\Resources;

use App\Http\Resources\GroupResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupsCollection extends ResourceCollection
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
            'groups' => GroupResource::collection($this->collection),
            'meta' => ['group_count' => $this->collection->count()],
        ];
    }
}
