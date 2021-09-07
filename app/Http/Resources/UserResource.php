<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'type' => $this->type,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_at' => Carbon::parse( $this->created_at )->format('d/m/Y'),
            'updated_at' => Carbon::parse( $this->updated_at )->format('d/m/Y'),
            'groups' => $this->groups
        ];
    }
}
