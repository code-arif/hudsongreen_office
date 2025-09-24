<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'location'      => $this->location,
            'start_time'    => $this->start_time,
            'end_time'      => $this->end_time,
            'work_date'     => $this->work_date,
            'is_completed'  => $this->is_completed,
            'team'          => [
                'id' => $this->team?->id,
                'name' => $this->team?->name,
                'unique_id' => $this->team?->unique_id,
            ],
            'category'      => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],
        ];
    }
}
