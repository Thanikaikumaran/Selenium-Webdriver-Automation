<?php

use App\Vehicle;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VehicleImport;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filepath = public_path("/database/seeders/vehicles.xlsx");
        Excel::import(new VehicleImport, $filepath);
    }
}
