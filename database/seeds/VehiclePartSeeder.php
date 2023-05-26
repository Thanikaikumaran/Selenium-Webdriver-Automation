<?php

use App\Vehicle;
use App\VehicleHasPart;
use App\VehiclePart;
use Illuminate\Database\Seeder;


class VehiclePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *  many to many relationship between vehicles and vehicle parts table.
         * So there will be a 3 table. 
         * 
         */
        $filepath = public_path("/database/seeders/parts.csv");

        $partsData = $this->readCSV($filepath);
        if (is_array($partsData) || is_object($partsData)) {
            foreach ($partsData as $key => $data) {
                $partsId = trim($data['id']);
                $partsName = trim($data['name']);
                $vehicleIds = isset($data['vehicle_ids']) ? $data['vehicle_ids'] : "";
                $active = trim($data['active']);

                /** check whether this parts record already exists in the vehicle_parts table.  */
                if (VehiclePart::where('parts_id', '=', $partsId)->count() == 0) {
                    VehiclePart::create([
                        'parts_id' => $partsId,
                        'name' => $partsName,
                        'active' => $active
                    ]);
                }

                if ($vehicleIds != "") {
                    $vehicleArr = array();
                    $vehicleArr = explode(",", $vehicleIds);
                    if (!empty($vehicleArr)) {
                        foreach ($vehicleArr as $key => $vId) {
                            /** check whether this vehicle record exists in the vehicle table.  */
                            if(Vehicle::where('vehicle_id', '=', $vId)->count() > 0){

                                /** check whether this vehicle has parts record already exists in the vehicle_has_parts table.  */
                                if (VehicleHasPart::where('parts_id', '=', $partsId)->where('vehicle_id', '=', $vId)->count() == 0) {
                                    VehicleHasPart::create(['parts_id' => $partsId, 'vehicle_id' => $vId]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    function readCSV($filename)
    {

        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $file = fopen($filename, "r");
        $i = 0;
        $headerArr = array();
        $partsArr = array();
        while (($partsData = fgetcsv($file, 1000, ";")) !== FALSE) {
            if ($i == 0) {
                $headerArr = $partsData;
                $i++;
                continue;
            }
            foreach ($partsData as $key => $value) {
                $partsArr[$i][$headerArr[$key]] = $value;
            }
            // $partsArr[$i]['vehicleIds'] = $vehicleIdArr;
            $i++;
        }
        fclose($file);
        return $partsArr;
    }
}
