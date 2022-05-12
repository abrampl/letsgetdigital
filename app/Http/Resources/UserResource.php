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
            'geo' => [
                'street' => $this->geo ? $this->geo->street_name : null,
                'city' => $this->geo ? $this->geo->city : null,
                'province' => $this->geo && $this->geo->administrative_areas ? $this->geo->administrative_areas[0]->name : null,
                'location' => [
                    'latitude' => $this->geo ? $this->geo->centroid->latitude : null,
                    'longitude' => $this->geo ? $this->geo->centroid->longitude : null,
                ],
            ],
        ];
    }
}
