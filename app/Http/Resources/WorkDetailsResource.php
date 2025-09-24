<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'location'      => $this->location,
            'is_completed'  => $this->is_completed,
            'description'   => $this->description,
            'time'          => $this->start_time?->format('h:i A') . ' - ' . $this->end_time?->format('h:i A'),
            'date'          => $this->work_date?->format('d M Y'),
            'short_note'    => $this->note ?? 'N/A',
            'unique_id'     => $this->unique_id,
            'images'        => $this->images->map(function ($image) {
                return url($image->image_path);
            }),
            'team'          => [
                'id' => $this->team?->id,
                'name' => $this->team?->name,
                'unique_id' => $this->team?->unique_id,
            ],
            'category'      => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],
            'coordinates'   => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],

        ];
    }
}
