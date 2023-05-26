<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class VehicleHasPart extends Model
{
     protected $fillable = [
        'vehicle_id', 
        'parts_id'
    ];


/**
 * getting the parts details by vehicle Id
 * 
 */
    public function getPartsByVehicleID($vehicleId){
       return DB::table('vehicle_parts as p')
        ->join('vehicle_has_parts as vp', 'p.parts_id', '=', 'vp.parts_id')
        ->leftJoin('vehicles as v', 'v.vehicle_id', '=', 'vp.vehicle_id')
        ->select(DB::raw('p.name'))
        ->where('vp.vehicle_id', $vehicleId)
        ->where('p.active', 1)
        ->orderBy('p.name')->get()->toarray();
    }
}
