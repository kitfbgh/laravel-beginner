<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = [];
        
        $result = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'register_at' => $this->register_at,
        ];
        
        return $result;
    }
}
