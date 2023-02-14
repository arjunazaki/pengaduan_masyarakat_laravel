<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PengaduanRes extends JsonResource
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
            'id_pengaduan' => $this -> id_pengaduan,
            'tanggal' => $this -> tanggal_pengaduan,
            'isi'=> $this -> isi_laporan,
            'status'=> $this -> status
        ];
    }
}
