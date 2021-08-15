<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurposalResource extends JsonResource
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
            'cover_letter'=> $this->cover_letter,
            'budget'=> $this->budget,
            'time'=> $this->time,
            'owner_id'=> $this->owner_id,
            'developer_id'=> $this->developer_id,
            'project_id'=> $this->project_id,

        ];




    }
}
