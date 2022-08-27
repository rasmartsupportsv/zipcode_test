<?php

namespace App\Http\Resources;

#use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

class ZipCodeCollection extends JsonResource
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
            'zip_code' => $this->d_CP,
            'locality' => strtoupper($this->d_ciudad),
            'federal_entity'=>[
                'key'=> intval($this->c_CP) ,
                'name'=>strtoupper($this->d_estado),
                'code'=>null
            ],
            'settlements'=> [[
                'key'=>intval($this->d_zona),
                'name'=>strtoupper($this->d_asenta),
                'zone_type'=>strtoupper($this->id_asenta_cpcons),
                'settlement_type'=>[
                    'name'=>$this->d_tipo_asenta,
                ]
            ]],
            'municipality'=>[
                'key'=> intval($this->c_tipo_asenta),
                'name'=>strtoupper($this->D_mnpio),
            ],
        ];
    }
}
