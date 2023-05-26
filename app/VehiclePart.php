<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiclePart extends Model
{
    protected $fillable = [
        'parts_id', 
        'name',
        'active',
    ];
}
