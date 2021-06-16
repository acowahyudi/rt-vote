<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KandidatResource extends JsonResource
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
            'no_calon' => $this->no_calon,
            'nama' => $this->nama,
            'foto' => $this->foto,
            'visi' => $this->visi,
            'periode_id' => $this->periode_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
