<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_id', 
        'bike_producer',
        'series',
        'size',
        'configuration',
        'bike_model',
        'sales_name',
        'year',
        'cylinder',
        'type_of_drive',
        'engine_output',
        'country',
        'category_one',
        'category_two'
    ];
}
