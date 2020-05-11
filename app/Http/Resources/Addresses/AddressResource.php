<?php

namespace App\Http\Resources\Addresses;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address_1' => $this->address_1,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'default' => (boolean) $this->default,
            'country' => new CountryResource($this->country),
        ];
    }
}
