<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HasilVotingResource extends JsonResource
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
            'id' => $this->id,
            'periode_id' => $this->periode_id,
            'penduduk_id' => $this->penduduk_id,
            'kandidat_id' => $this->kandidat_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
