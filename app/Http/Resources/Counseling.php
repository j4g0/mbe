<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Counseling extends JsonResource
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
        'client_id'   => $this->client_id,
        'client_name' => $this->client->first_name . " " . $this->client->last_name,
        'description' => $this->description,
        'date'        => $this->date
      ];
    }
}
