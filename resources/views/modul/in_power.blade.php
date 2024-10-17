@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-bar-chart-alt-2 me-1 font-22 text-primary"></i></div>
                    <h5 class="mb-0 text-primary">Submit Data</h5>
                </div>
                <hr/>
                <form action="{{ route('rectifier.store') }}" id="powerForm" method="POST">
                    @csrf
                    <!-- Tab 1: Site Selection -->
                    <div class="tab">
                        <p>
                            <label for="selectSite" class="form-label">Select Site</label>
                            <select class="form-select single-select" id="selectSite" name="site"
                                aria-label="Default select example" onchange="this.className = this.className.replace(' invalid', '')">
                                <option value=""></option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}" data-address="{{ $site->address }}">
                                        {{ $site->site_id }}-{{ $site->site_name }}
                                    </option>
                                @endforeach
                            </select>
                        </p>
                        <p>
                            <label for="address" class="form-label">Address</label>
                            <input class="form-control" type="text" id="address" name="address" placeholder="Address"
                                aria-label="default input example" readonly>
                        </p>
                    </div>
                    <!-- Tab 2: Pelanggan and Daya -->
                    <div class="tab">
                        <p>
                            <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
                            <input class="form-control" type="text" id="id_pelanggan" name="id_pelanggan"
                                placeholder="ID Pelanggan" aria-label="default input example">
                        </p>
                        <p>
                            <label for="daya" class="input-group-label">Daya</label>
                            <div class="input-group">
                                <input type="number" id="daya" class="form-control" placeholder="Daya"
                                    aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Watt</span>
                            </div>
                        </p>
                    </div>
                    <!-- Tab 3: Rectifier and Battery Info -->
                    <div class="tab">
                        <p>
                            <label for="recti_name" class="form-label">Rectifier Name</label>
                            <input type="text" id="recti_name" name="recti_name" class="form-control" placeholder="Rectifier 1">
                        </p>
                        <p>
                            <label for="recti_brand" class="form-label">Rectifier Brand</label>
                            <select id="recti_brand" name="recti_brand" class="form-select single-select">
                                <option value="">--</option>
                                <option value="Emerson">Emerson</option>
                                <option value="Hariff">Hariff</option>
                                <option value="Vertiv">Vertiv</option>
                            </select>
                        </p>
                        <p>
                            <label for="battery_brand" class="form-label">Battery Brand</label>
                            <select id="battery_brand" class="form-select single-select" name="battery_brand">
                                <option value="">--</option>
                                <option value="Brand A">Brand A</option>
                                <option value="Brand B">Brand B</option>
                                <option value="Brand C">Brand C</option>
                            </select>
                        </p>
                        <p>
                            <label for="battery_type" class="form-label">Battery Type</label>
                            <select id="battery_type" class="form-select single-select" name="battery_type">
                                <option value=""></option>
                                <option value="Lithium">Lithium</option>
                                <option value="VRLA">VRLA</option>
                            </select>
                        </p>
                        <p>
                            <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="batteryQuantity" name="battery_quantity">
                                    <option selected>Choose...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value=">6">>6</option>
                                </select>
                                <select class="form-select" name="battery_status">
                                    <option selected>Battery Status</option>
                                    <option value="Good">Good</option>
                                    <option value="Degraded">Degraded</option>
                                </select>
                            </div>
                        </p>
                        <p>
                            <label class="form-label" for="inAprQuantity">APR Quantity</label>
                            <select class="form-select single-select" id="inAprQuantity" name="apr_quantity">
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </p>
                        <p>
                            <label for="bus_voltage" class="form-label">Bus Voltage</label>
                            <div class="input-group">
                                <input type="number" name="bus_voltage" id="bus_voltage" class="form-control" placeholder="Bus Voltage" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Volt</span>
                            </div>
                        </p>
                        <p>
                            <label for="load" class="form-label">Load</label>
                            <div class="input-group">
                                <input type="number" name="load" id="load" class="form-control" placeholder="Bus Voltage" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Ampere</span>
                            </div>
                        </p>
                        <p>
                            <label for="backup_time" class="form-label">Backup Time</label>
                            <div class="input-group">
                                <input type="number" name="backup_time" id="backup_time" class="form-control" placeholder="Bus Voltage" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Hour</span>
                            </div>
                        </p>
                        <p>
                            <label for="id_equipment" class="form-label">Select Equipments</label>
                            <select name="equipment_ids[]" id="id_equipment" class="multiple-select" multiple="multiple">
                                @foreach($equipments as $equipment)
                                    <option value="{{ $equipment->id }}">{{ $equipment->equipment_name }}</option>
                                @endforeach
                            </select>                        
                        </p>
                    </div>
                    <!-- Navigation buttons -->
                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" class="btn btn-secondary" id="prevBtn">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextBtn">Next</button>                                                    </div>
                        </div>
                    <!-- Step indicators -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
