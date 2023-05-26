<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleHasPart;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Session;

class VehicleController extends Controller
{

    public function index(Request $request)
    {
        $isVehicle = 1;
        $bikeProducerArr = $this->getAllBrandList();
        return view('vehicles.index', compact('bikeProducerArr', 'isVehicle'));
    }



    /**
     * view vehicle parts by vehicle Id
     * 
     */
    public function vehicleParts($vehicleId)
    {
        $vehicleData = Vehicle::where("vehicle_id", $vehicleId)->get()->toarray();
        if (isset($vehicleData[0])) {
            $vehicleData = $vehicleData[0];
        }

        $vehicleHasParts = new VehicleHasPart();
        $partsData = $vehicleHasParts->getPartsByVehicleID($vehicleId);

        $isVehicle = 0;
        $bikeProducerArr = $this->getAllBrandList();
        return view('vehicles.index', compact('vehicleId', 'bikeProducerArr', 'isVehicle', 'vehicleData', 'partsData'));
    }




    /**
     * Filter data clear
     * 
     */
    public function clearFilter()
    {
        Session::forget('MY_SESSION');
        return redirect()->action('VehicleController@index');
    }



    /**
     * generate datatable to load the vehicle list
     * 
     */
    public function getVehicleList(Request $request)
    {
        $this->setSession($request->all());

        $vehicle = Vehicle::select(['*']);
        return Datatables::of($vehicle)->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if ($request->has('bikeName') && $request->input('bikeName') != "") {
                    $query->where('bike_producer', "{$request->get('bikeName')}");
                }
                if ($request->has('modelName') && $request->input('modelName') != "0") {
                    $query->where('bike_model', "{$request->get('modelName')}");
                }
                if ($request->has('engineSize') && $request->input('engineSize') != "0") {
                    $query->where('size', "{$request->get('engineSize')}");
                }
                if ($request->has('modelYear') && $request->input('modelYear') != "0") {
                    $query->where('year', $request->get('modelYear'));
                }
            })
            ->editColumn('bike_producer', function ($query) {
                $bikeProducer = "<a data-toggle='tooltip' title='View Available Parts' href='vehicle/" . $query->vehicle_id . "' >
                " . $query->bike_producer . "</a>";
                return $bikeProducer;
            })
            ->rawColumns(['bike_producer'])->make(true);
    }






    /**
     * Filter data storeing in the session
     * 
     */
    function setSession($input)
    {
        $arr = array();
        if ($input['bikeName'] != null && $input['bikeName'] != "0") {
            $arr['bikeName'] = $input['bikeName'];
        }
        if ($input['modelName'] != null && $input['modelName'] != "0") {
            $arr['modelName'] = $input['modelName'];
        }
        if ($input['engineSize'] != null && $input['engineSize'] != "0") {
            $arr['engineSize'] = $input['engineSize'];
        }
        if ($input['modelYear'] != null && $input['modelYear'] != "0") {
            $arr['modelYear'] = $input['modelYear'];
        }
        Session::put('MY_SESSION', $arr);
    }




    /**
     * Get all brand name list to initial load
     */
    function getAllBrandList()
    {
        return Vehicle::select('bike_producer')->distinct()->orderBy('bike_producer', 'ASC')->get()->toarray();
    }



    /**
     * Get all model name list to model dd load
     */
    function getVehicleModelList(Request $request)
    {
        $brandName = $request->bikeName;
        return $this->getVehicleInfor('bike_model', 'ASC', $brandName);
    }



    /**
     * Get all engine size list to size dd load
     */
    function getVehicleEngineList(Request $request)
    {
        $bikeProducer = $request->bikeName;
        $bikeModel = $request->modelName;
        return $this->getVehicleInfor('size', 'ASC', $bikeProducer, $bikeModel);
    }


    /**
     * Get all model year list to year dd load
     */

    function getVehicleModelYearList(Request $request)
    {
        $bikeProducer = $request->bikeName;
        $bikeModel = $request->modelName;
        $engineSize = $request->engineSize;
        return $this->getVehicleInfor('year', 'DESC', $bikeProducer, $bikeModel, $engineSize);
    }




    /**
     * Get vehicle data by 
     *  - brand
     *  - model
     *  - size
     *  - year
     */
    function getVehicleInfor($selectedField, $orderBy, $bikeProducer = null, $bikeModel = null, $engineSize = null)
    {
        $data = array();
        if ($bikeProducer != "") {
            $data =  Vehicle::where('bike_producer', $bikeProducer)
                ->where(function ($query) use ($bikeModel, $engineSize) {
                    if ($bikeModel != "" && $bikeModel != "0") {
                        $query->where('bike_model', $bikeModel);
                    }
                    if ($engineSize != "" && $engineSize != "0") {
                        $query->where('size', $engineSize);
                    }
                })
                ->where($selectedField, '!=', "")
                ->select($selectedField)
                ->distinct()
                ->orderBy($selectedField, $orderBy)
                ->get()
                ->toarray();
        }

        return json_encode($data);
    }
}
