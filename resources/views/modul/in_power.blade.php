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
                <form action="" id="powerForm">
                    <!-- Tab 1: Site Selection -->
                    <div class="tab">
                        <p>
                            <label for="selectSite" class="form-label">Select Site</label>
                            <select class="form-select single-select" id="selectSite" name="site"
                                aria-label="Default select example" oninput="this.className = this.className.replace(' invalid', '')">
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
                            <label for="inIdPelanggan" class="form-label">ID Pelanggan</label>
                            <input class="form-control" type="text" id="inIdPelanggan" name="id_pelanggan"
                                placeholder="ID Pelanggan" aria-label="default input example" oninput="this.className = this.className.replace(' invalid', '')">
                        </p>
                        <p>
                            <label for="inDaya" class="form-label">Daya</label>
                            <div class="input-group">
                                <input type="number" id="inDaya" class="form-control" placeholder="Daya"
                                    aria-describedby="basic-addon2" oninput="this.className = this.className.replace(' invalid', '')">
                                <span class="input-group-text" id="basic-addon2">Watt</span>
                            </div>
                        </p>
                    </div>
                    <!-- Tab 3: Rectifier and Battery Info -->
                    <div class="tab">
                        <p>
                            <label for="rectiName" class="form-label">Rectifier Name</label>
                            <input type="text" id="rectiName" name="recti_name" class="form-control"
                                placeholder="Rectifier 1" oninput="this.className = this.className.replace(' invalid', '')">
                        </p>
                        <p>
                            <label for="inRectiBrand" class="form-label">Rectifier Brand</label>
                            <select id="inRectiBrand" name="recti_brand" class="form-select single-select" oninput="this.className = this.className.replace(' invalid', '')">
                                <option value="">--</option>
                                <option value="Emerson">Emerson</option>
                                <option value="Hariff">Hariff</option>
                                <option value="Vertiv">Vertiv</option>
                            </select>
                        </p>
                        <p>
                            <label for="inBatteryBrand" class="form-label">Battery Brand</label>
                            <select id="inBatteryBrand" class="form-select single-select" name="battery_brand" oninput="this.className = this.className.replace(' invalid', '')">
                                <option value="">--</option>
                                <option value="Brand A">Brand A</option>
                                <option value="Brand B">Brand B</option>
                                <option value="Brand C">Brand C</option>
                            </select>
                        </p>
                        <p>
                            <label for="inBatteryType" class="form-label">Battery Type</label>
                            <select id="inBatteryType" class="form-select single-select" name="battery_type" oninput="this.className = this.className.replace(' invalid', '')">
                                <option value=""></option>
                                <option value="Lithium">Lithium</option>
                                <option value="VRLA">VRLA</option>
                            </select>
                        </p>
                        <p>
                            <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                            <div class="input-group mb-3">
                                <select class="form-select" id="batteryQuantity" name="battery_quantity" oninput="this.className = this.className.replace(' invalid', '')">
                                    <option selected>Choose...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value=">6">>6</option>
                                </select>
                                <select class="form-select" name="battery_status" oninput="this.className = this.className.replace(' invalid', '')">
                                    <option selected>Battery Status</option>
                                    <option value="Good">Good</option>
                                    <option value="Degraded">Degraded</option>
                                </select>
                            </div>
                        </p>
                        <p>
                            <label class="form-label" for="inAprQuantity">APR Quantity</label>
                            <select class="form-select single-select" id="inAprQuantity" name="apr_quantity" oninput="this.className = this.className.replace(' invalid', '')">
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
                            <label for="busVoltage" class="form-label">Bus Voltage</label>
                            <div class="input-group">
                                <input type="number" id="busVoltage" class="form-control" placeholder="Bus Voltage"
                                    aria-describedby="basic-addon2" oninput="this.className = this.className.replace(' invalid', '')">
                                <span class="input-group-text" id="basic-addon2">Volt</span>
                            </div>
                        </p>
                    </div>
                    <!-- Navigation buttons -->
                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
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
