<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZipCodeRequest;
use App\Http\Requests\UpdateZipCodeRequest;
use App\Models\ZipCode;
use  App\Http\Resources\ZipCodeCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ZipCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $settlements = DB::table('codezip')
         ->where('d_codigo',76000)
            ->select('id_asenta_cpcons','d_asenta', 'd_zona','d_tipo_asenta')
            ->get();

        $array = [];

        foreach ($settlements as $key => $value) {
            $array[]=[
                'key'=>intval($value->id_asenta_cpcons),
                'name'=>strtoupper($value->d_asenta),
                'zone_type'=>strtoupper($value->d_zona),
                'settlement_type'=>[
                    'name'=>$value->d_tipo_asenta,
                ]
            ];
        }


        return response()->json($array);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZipCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZipCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function show($zip_code)
    {
        $ZipCode = Cache::remember($zip_code, 1000, function() use ($zip_code) {

            return new ZipCodeCollection(ZipCode::where('d_codigo',$zip_code)->first());
        });

        return $ZipCode;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function edit(ZipCode $zipCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZipCodeRequest  $request
     * @param  \App\Models\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZipCodeRequest $request, ZipCode $zipCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ZipCode  $zipCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZipCode $zipCode)
    {
        //
    }
}
