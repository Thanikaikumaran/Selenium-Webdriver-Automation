@extends('layouts.app')
@section('content')

<?php
if (!isset($vehicleData)) {
    $vehicleData = array();
}
if (!isset($partsData)) {
    $partsData = array();
}
if (!isset($vehicleId)) {
    $vehicleId = 0;
}
// filter data is getting from session
if (Session::get('MY_SESSION')) {
    $req = Session::get('MY_SESSION');
    $brandName = isset($req['bikeName']) ? $req['bikeName'] : "";
    $modelName = isset($req['modelName']) ? $req['modelName'] : "";
    $engineSize = isset($req['engineSize']) ? $req['engineSize'] : "";
    $year = isset($req['modelYear']) ? $req['modelYear'] : "";
} else {
    $brandName = "";
    $modelName = "";
    $engineSize = "";
    $year = "";
}
?>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome to Inventory Management System </h3>
            <h4 class="font-weight-normal mb-0">let's find out your dream bikes </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <h4 class="font-weight-normal mb-0">Vehicle Search </h4>
            <br/>
                <form action="{{ route('vehicle') }}" method="POST" id="search-form" enctype="multipart/form-data" class="md-float-material form-material">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="form-control form-control-sm" name="search_bike" id="search_bike">
                                    <option value="0">All</option>
                                    <?php
                                    foreach ($bikeProducerArr as  $bikeName) { ?>
                                        <option value="<?php echo $bikeName['bike_producer']; ?>" <?php if ($brandName == $bikeName['bike_producer']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $bikeName['bike_producer']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Model</label>
                                <select class="form-control form-control-sm" name="search_model" id="search_model">
                                    <option value="0">All</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Engine Size</label>
                                <select class="form-control form-control-sm" name="search_engin_size" id="search_engin_size">
                                    <option value="0">All</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Year</label>
                                <select class="form-control form-control-sm" name="search_model_year" id="search_model_year">
                                    <option value="0">All</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    Search Filter
                                </button>
                                <a href="{{ route('clearFilter') }}"><button class="btn btn-secondary btn-sm" type="button">
                                        Clear the filter
                                    </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- isVehicle is 1 means, this is vechicle data -->
    <?php if ($isVehicle) { ?>
        <div class="col-md-9 grid-margin">
            <div class="card">
                <div class="card-body">
                    <!-- Vehicle data -->
                    <div class="table-responsive">
                        <table id="tbl-vehicle" class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>Sales Name</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <!-- Vehicle parts data -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-0">Vehicle Details </h4>
                            <br />
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-4">
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Brand</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['bike_producer'])?$vehicleData['bike_producer']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Model</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['bike_model'])?$vehicleData['bike_model']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Sales Name</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['sales_name'])?$vehicleData['sales_name']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Year</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['year'])?$vehicleData['year']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Country</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['country'])?$vehicleData['country']:"-" }}
                                        </span>
                                    </p>
                                </div>


                                <div class="col-12 col-md-6 col-xl-4">
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Series</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['series'])?$vehicleData['series']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Size</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['size'])?$vehicleData['size']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Configuration</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['configuration'])?$vehicleData['configuration']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Cylinder</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['cylinder'])?$vehicleData['cylinder']:"-" }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Type of Drive</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['type_of_drive'])?$vehicleData['type_of_drive']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Engine Output</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['engine_output'])?$vehicleData['engine_output']:"-" }}
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <span class="float-left  text-primary">
                                            <b>Category</b> &nbsp;&nbsp;
                                        </span>
                                        <span class="float-none text-muted">
                                            {{ isset($vehicleData['category_one'])?$vehicleData['category_one']:"" }}
                                            &nbsp;,&nbsp;
                                            {{ isset($vehicleData['category_two'])?$vehicleData['category_two']:"" }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Display the Parts data -->
                <?php
                if (!empty($partsData)) { ?>
                    <div class="col-md-12 grid-margin">
                        <h4 class="font-weight-normal mb-0">Parts Details </h4>
                        <br />
                    </div>
                    <?php
                    foreach ($partsData as $key => $part) { ?>
                        <div class="col-md-2  parts-list">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex flex-row flex-wrap text-center">
                                        <img src="{{ asset('plugins/images/part.jpg')}}" class="img-lg rounded" alt="profile image">
                                        <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <h6 class="mb-0">{{ isset($part->name)?$part->name:"" }}</h6>
                                            <p class="mb-0 text-success font-weight-bold">Available</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-md-12 grid-margin">
                        <h4 class="font-weight-normal mb-0">Parts Details </h4>
                        <br />
                        <h5 class="font-weight-normal mb-0">Not Available </h5>
                    </div>

                <?php }
                ?>
            </div>
        </div>
    <?php }  ?>
</div>
@endsection
@push('moreJs')
<script>

    $(document).ready(function() {
        var isVehicle = '<?php echo $isVehicle; ?>';
        if (isVehicle == '1') {
            var oTable = $('#tbl-vehicle').DataTable({
                "processing": true,
                "serverSide": true,
                "searching": false,
                "iDisplayLength": 5,
                "bSort": false,
                "bFilter": false,
                "bLengthChange": true,
                "lengthMenu": [5, 10, 20],
                ajax: {
                    url: "{{ route('vehiclesList') }}",
                    data: function(d) {
                        d.bikeName = $('select[name=search_bike]').val();
                        d.modelName = $('select[id=search_model]').val();
                        d.engineSize = $('select[name=search_engin_size]').val();
                        d.modelYear = $('select[name=search_model_year]').val();
                        d._token = '{{csrf_token()}}';
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bike_producer',
                        name: 'bike_producer',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'bike_model',
                        name: 'bike_model',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'year',
                        name: 'year',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'sales_name',
                        name: 'sales_name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'country',
                        name: 'country',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#search-form').submit(function(event) {
                event.preventDefault();
                oTable.draw();
            });
        }       
        getBikeModel();
        getEnginSize();
        getModelYear();
    });

    $('#search_bike').on('change', function(e) {
        getBikeModel(this.value);
        getEnginSize(this.value);
        getModelYear(this.value);
    });

    $('#search_model').on('change', function(e) {
        getEnginSize(this.value);
        getModelYear(this.value);
    });

    $('#search_engin_size').on('change', function(e) {
        getModelYear(this.value);
    });


    function getBikeModel() {
        var vehicleModelName = '<?php echo $modelName; ?>';
        $('#search_model option').remove();
        $('#search_model').append($("<option></option>")
            .attr("value", "0")
            .text("All"));
        var dataArr;
        $.ajax({
            type: "POST",
            url: "{{ route('showBikeModelList') }}",
            dataType: "json",
            data: {
                bikeName: $('#search_bike').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(msg) {
                dataArr = msg;
                $.each(dataArr, function(i) {
                    if (dataArr[i]['bike_model'] == vehicleModelName) {
                        $('#search_model').append($("<option></option>")
                            .attr("value", dataArr[i]['bike_model']).attr("selected", "selected")
                            .text(dataArr[i]['bike_model']));
                    } else {

                        $('#search_model').append($("<option></option>")
                            .attr("value", dataArr[i]['bike_model'])
                            .text(dataArr[i]['bike_model']));
                    }
                });
            }
        });

    }



    function getEnginSize() {
        var engineSize = '<?php echo $engineSize; ?>';
        $('#search_engin_size option').remove();
        $('#search_engin_size').append($("<option></option>")
            .attr("value", "0")
            .text("All"));
        var dataArr;
        $.ajax({
            type: "POST",
            url: "{{ route('showEnginSizeList') }}",
            dataType: "json",
            data: {
                bikeName: $('#search_bike').val(),
                modelName: $('#search_model').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(msg) {
                dataArr = msg;
                $.each(dataArr, function(i) {
                    if (dataArr[i]['size'] == engineSize) {
                        $('#search_engin_size').append($("<option></option>")
                            .attr("value", dataArr[i]['size']).attr("selected", "selected")
                            .text(dataArr[i]['size']));
                    } else {
                        $('#search_engin_size').append($("<option></option>")
                            .attr("value", dataArr[i]['size'])
                            .text(dataArr[i]['size']));
                    }
                });
            }
        });
    }



    function getModelYear() {
        var year = '<?php echo $year; ?>';
        $('#search_model_year option').remove();
        $('#search_model_year').append($("<option></option>")
            .attr("value", "0")
            .text("All"));
        var dataArr;
        $.ajax({
            type: "POST",
            url: "{{ route('showModelYearList') }}",
            dataType: "json",
            data: {
                bikeName: $('#search_bike').val(),
                modelName: $('#search_model').val(),
                engineSize: $('#search_engin_size').val(),
                _token: '{{csrf_token()}}'
            },
            success: function(msg) {
                dataArr = msg;
                $.each(dataArr, function(i) {
                    if (dataArr[i]['year'] == year) {
                        $('#search_model_year').append($("<option></option>")
                            .attr("value", dataArr[i]['year']).attr("selected", "selected")
                            .text(dataArr[i]['year']));
                    } else {
                        $('#search_model_year').append($("<option></option>")
                            .attr("value", dataArr[i]['year'])
                            .text(dataArr[i]['year']));
                    }
                });
            }
        });
    }
</script>
@endpush