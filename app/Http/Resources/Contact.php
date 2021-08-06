<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Contact extends JsonResource
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
            'data' => [
                'type' => 'contacts',
                'id' => $this->id,
                'attributes' => [
                    'user' => $this->user->name,
                    'name' => $this->name,
                    'email' => $this->email,
                    'cellphone' => $this->cellphone,
                    'birthdate' => $this->birthdate->format('jS F, Y'),
                    'note' => $this->note,
                    'updated_at' => $this->updated_at->diffForHumans(),
                ]
            ],
            'links' => [
                'self' => $this->path(),
            ]
        ];
    }
}
