<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'gender'       => $this->gender,
            'age'          => $this->date_of_birth ? Carbon::parse($this->date_of_birth)->age : null,
            'date_of_birth'      => $this->date_of_birth,
            'class'        => $this->class,
            'section'      => $this->section,
            'roll'      => $this->class_roll,
            'created_by'   => $this->creator ? $this->creator->username : null,
            'school'       => $this->whenLoaded('school', function () {
                return [
                    'id'             => $this->school->id,
                    'name'             => $this->school->name,
                    'principal_name'           => $this->school->principal_name,
                    'phone'           => $this->school->phone ?? null,
                    'street_address'           => $this->school->street_address ?? null,
                    'city'           => $this->school->city,
                    'state'           => $this->school->state,
                    'zip_code'           => $this->school->zip_code,
                ];
            }),
        ];
    }
}
