<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PendudukResource extends JsonResource
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
            'nama' => $this->nama,
            'nik' => $this->nik,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tgl_lahir' => $this->tgl_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'agama' => $this->agama,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
