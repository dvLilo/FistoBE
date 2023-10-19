<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->id) {
            return [
                'account_titles' => $this->document_coa->map(function ($document_coa) {
                    return [
                        'entry' => $document_coa->entry,
                        'account_title' => [
                            'id' => $document_coa->account_title->id,
                            'name' => $document_coa->account_title->title,
                        ],
                        'company' => [
                            'id' => $document_coa->company->id,
                            'name' => $document_coa->company->company,
                        ],
                        'department' => [
                            'id' => $document_coa->department->id,
                            'name' => $document_coa->department->department
                        ],
                        'location' => [
                            'id' => $document_coa->location->id,
                            'name' => $document_coa->location->location
                        ]
                    ];
                })
            ];
        } else {
            return [
                'id' => $this->id,
                'type' => $this->type,
                'description' => $this->description,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'accounts' => $this->document_coa->map(function ($document_coa) {
                    return [
                        'entry' => $document_coa->entry,
                        'account_title' => [
                            'id' => $document_coa->account_title->id,
                            'name' => $document_coa->account_title->title,
                        ],
                        'company' => [
                            'id' => $document_coa->company->id,
                            'name' => $document_coa->company->company,
                        ],
                        'department' => [
                            'id' => $document_coa->department->id,
                            'name' => $document_coa->department->department
                        ],
                        'location' => [
                            'id' => $document_coa->location->id,
                            'name' => $document_coa->location->location
                        ]
                    ];
                })
            ];
        }

    }
}