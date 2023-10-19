<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'department' => [
                'id' => $this->department->id,
                'name' => $this->department->department
            ],
            'code' => $this->code,
            'subunit' => $this->subunit,
            'created_at' => $this->created_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
