<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'initials' => $this->initials,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'zipcode' => $this->zipcode,
            'house_number' => $this->house_number,
            'email' => $this->email,
            'phone' => $this->phone,
            'geo' => $this->mergeWhen($this->geo, [
                'street' => $this->geo->street_name,
                'city' => $this->geo->city,
                'province' => $this->when($this->geo->administrative_areas, $this->geo->administrative_areas[0]->name),
                'location' => [
                    'latitude' => $this->geo->centroid->latitude,
                    'longitude' => $this->geo->centroid->longitude,
                ],
            ]),
        ];
    }
}
