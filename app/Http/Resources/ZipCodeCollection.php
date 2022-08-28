<?php

namespace App\Http\Resources;

#use Illuminate\Http\Resources\Json\ResourceCollection;

use Illuminate\Http\Resources\Json\JsonResource;

use ZipCodeSettlementsCollection;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

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

        $settlements = DB::table('codezip')
         ->where('d_codigo',$this->d_codigo)
            ->select('id_asenta_cpcons','d_asenta', 'd_zona','d_tipo_asenta')
            ->get();

        $array = [];

        foreach ($settlements as $key => $value) {
            $array[]=[
                'key'=>intval($value->id_asenta_cpcons),
                'name'=>$this->eliminar_acentos($value->d_asenta),
                'zone_type'=>$this->eliminar_acentos($value->d_zona),
                'settlement_type'=>[
                    'name'=>$value->d_tipo_asenta,
                ]
            ];
        }
         
        return [
            'zip_code' => $this->d_codigo,
            'locality' => $this->eliminar_acentos($this->d_ciudad),
            'federal_entity'=>[
                'key'=> intval($this->c_estado) ,
                'name'=>$this->eliminar_acentos($this->d_estado),
                'code'=>null
            ],
            'settlements'=>$array,
            'municipality'=>[
                'key'=> intval($this->c_mnpio),
                'name'=>$this->eliminar_acentos($this->D_mnpio),
            ],
        ];
    }


    function eliminar_acentos($cadena){
        
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );

        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );

        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena );

        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena );

        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );

        //Reemplazamos la N, n, C y c
        $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç'),
        array('N', 'n', 'C', 'c'),
        $cadena
        );
        
        return strtoupper($cadena);
    }
}
