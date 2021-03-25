<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CourseResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'outline' => $this->outline,
            'students' => new StudentResource($this->students),
        ];
    }

    /**
    * @param \Illuminate\Http\Request $request
    * @return array
    */
    public function with($request)
    {
        return [
            'metadata' => Carbon::now(),
        ];
    }
}
