<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargeRemarkDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'          => $this->id,
            'user'        => $this->user->name,
            // 'charge'      => $this->charge->name,
            'member'      => $this->member->name ?? '未定',
            'work_on'     => $this->work_on,
            'time_type'   => $this->time_type,
            'remarks'     => $this->remarks,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
