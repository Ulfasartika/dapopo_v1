@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div id="smartwizard">
                    <form class="row g-3" id="submitRecti" method="POST" action="{{ route('rectifier.create.step.three.post') }}">
                        @csrf
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <div class="card">
                                <div class="card-body pg-5">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Rectifier Name</label>
                                        <input type="text" name="recti_name" class="form-control" placeholder="Rectifier 1">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Rectifier Brand</label>
                                        <select for="inputRectifierBrand" name="recti_brand" class="form-control">
                                            <option value="">--</option>
                                            <option value="Emerson">Emerson</option>
                                            <option value="Hariff">Hariff</option>
                                            <option value="Vertiv">Vertiv</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputBatteryBrand" class="form-label">Battery Brand</label>
                                        <select for="inputBatteryBrand" class="form-control" name="id_battery">
                                            <option value="">--</option>
                                            <option value="">Brand A</option>
                                            <option value="">Brand B</option>
                                            <option value="">Brand C</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputBatteryType" class="form-label">Battery Type</label>
                                        <select class="form-control" name="id_bat_type">
                                            <option value="">--</option>
                                            <option value="">Lithium</option>
                                            <option value="">VRLA</option>
                                        </select>
                                    </div>
                                    <div class="additionalBattery input-group mb-3">
                                        <div class="col-md-12">
                                            <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                                            <i type="button" class="text-primary" id="addBattery"
                                                data-feather="plus-circle" style="cursor: pointer;"></i>
                                        </div>
                                        <div class="col-8">
                                            <select class="form-control" name="battery_quantity"
                                                id="batteryQuantity">
                                                <option value="">--</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value=">6">>6</option>
                                            </select>
                                        </div>
                                        <select class="form-select" name="battery_status" id="inputGroupSelect01">
                                            <option selected>Battery Status</option>
                                            <option value="1">Good</option>
                                            <option value="2">Degraded</option>
                                        </select>
                                        <div id="additionalBattery"></div> <!-- Tempat untuk input baterai tambahan -->
                                        <div class="col-md-12">
                                            <label class="form-label">APR Quantity</label>
                                            <select class="form-control" name="apr_quantity">
                                                <option value="">--</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                                <option value="">4</option>
                                                <option value="">5</option>
                                                <option value="">6</option>
                                                <option value="">7</option>
                                                <option value="">8</option>
                                                <option value="">9</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="basic-addon2" class="form-label">Bus Voltage</label>
                                            <div class="input-group input-group mb-3"> <span class="input-group-text"
                                                    id="inputGroup-sizing-sm">Volt</span>
                                                <input type="text" name="bus_voltage" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{ route('rectifier.create.step.two') }}" id="prev-btn" class="btn btn-secondary">Previous</a>
                                        <button type="button" id="finish-btn" class="btn btn-info">Finish</button>
                                        <button type="button" id="cancel-btn" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
