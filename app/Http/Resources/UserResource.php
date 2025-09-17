<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $school = $this->school;
        $contact = $school?->contact?->first();

        return [
            'school' => $school ? [
                'id'   => $school->id,
                'name' => $school->name,
                'principal_name' => $school->principal_name,
                'email' => $school->email,
                'phone' => $school->phone,
                'street_address' => $school->street_address,
                'city' => $school->city,
                'state' => $school->state,
                'zip_code' => $school->zip_code,
                'approximate_student_count' => $school->approximate_student_count,
            ] : null,

            'contact' => $contact ? [
                'id' => $contact->id,
                'school_id' => $contact->school_id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'role' => $contact->role ?? 'PE Teacher',
            ] : null,

            'user' => [
                'id' => $this->id,
                'school_id' => $school->id,
                'username' => $this->username,
                'email' => $this->email,
                'role' => $this->role,
            ],
        ];
    }
}
