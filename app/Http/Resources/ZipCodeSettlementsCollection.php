<?php

namespace App\Http\Resources;

#use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;


class ZipCodeSettlementsCollection extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                'key'=>intval($this->id_asenta_cpcons),
                'name'=>strtoupper($this->d_asenta),
                'zone_type'=>strtoupper($this->d_zona),
                'settlement_type'=>[
                    'name'=>$this->d_tipo_asenta,
                ]
        ];
    }
}
