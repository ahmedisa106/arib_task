<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResurce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'departments' => $this->whenLoaded('departments',function (){
                return DepartmentResource::collection($this->departments);
            }),
            'employees' => $this->whenLoaded('employees',function (){
                return EmployeeResource::collection($this->employees);
            }),

        ];
    }
}
