<?php

namespace App\Imports;

use App\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehicleImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Vehicle([

            'vehicle_id'     => isset($row['vehicle_id'])? e(trim($row['vehicle_id'])):0,
            'bike_producer'    =>  isset($row['bike_producer'])? e(trim($row['bike_producer'])):"",
            'series' => isset($row['series'])? e(trim($row['series'])):"",
            'size' => isset($row['size'])? e(trim($row['size'])):0,
            'configuration' => isset($row['configuration'])? e(trim($row['configuration'])):"",
            'bike_model' => isset($row['bike_model'])? e(trim($row['bike_model'])):"",
            'sales_name' => isset($row['sales_name'])? e(trim($row['sales_name'])):"",
            'year' => isset($row['year'])? e(trim($row['year'])):0,
            'cylinder' => isset($row['cylinder'])? e(trim($row['cylinder'])):0,
            'type_of_drive' => isset($row['type_of_drive'])? e(trim($row['type_of_drive'])):"",
            'engine_output' => isset($row['engine_output'])? e(trim($row['engine_output'])):"",
            'country' => isset($row['country'])? e(trim($row['country'])):"",
            'category_one' => isset($row['category_1'])? e(trim($row['category_1'])):"",
            'category_two' => isset($row['category_2'])? e(trim($row['category_2'])):"",
        ]);
    }
}
