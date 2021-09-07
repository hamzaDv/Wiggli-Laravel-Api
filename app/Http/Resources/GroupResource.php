<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Http\Resources\UserResource;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'created_at' => Carbon::parse( $this->created_at )->format('d/m/Y'),
            'updated_at' => Carbon::parse( $this->updated_at )->format('d/m/Y'),
            'users' => $this->users
            // 'user' => UserResource::collection($this->users)
        ];
    }
}
