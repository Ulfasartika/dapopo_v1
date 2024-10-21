@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('rectifier.store') }}" method="POST">
                        @csrf
                        <!-- Step 1: Site Information -->
                        <div class="form-step">
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="id_site" class="form-label">Site ID</label>
                                <select class="form-select single-select" id="selectSite" name="id_site"
                                    aria-label="Default select example">
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">
                                            {{ $site->site_id }} - {{ $site->site_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 2: Customer Information -->
                        <div class="form-step d-none">
                            <h4>Step 2: Customer Information</h4>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">Customer ID</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <label for="daya" class="form-label">Power (Daya)</label>
                                <input type="number" class="form-control" id="daya" name="daya" required>
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 3: Rectifier and Battery Information -->
                        <div class="form-step d-none">
                            <h4>Step 3: Rectifier and Battery Information</h4>
                            <div class="mb-3">
                                <label for="recti_name" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" id="recti_name" name="recti_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="inRectiBrand" class="form-label">Rectifier Brand</label>
                                <select id="inRectiBrand" name="recti_brand" class="form-select single-select">
                                    <option value="">--</option>
                                    <option value="Emerson">Emerson</option>
                                    <option value="Hariff">Hariff</option>
                                    <option value="Vertiv">Vertiv</option>
                                </select>
                            </div>
                            <div class="mb-3">
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
                            </div>
                            <div class="mb-3">
                                <label for="bus_voltage" class="form-label">Bus Voltage</label>
                                <input type="number" class="form-control" id="bus_voltage" name="bus_voltage" required>
                            </div>
                            <div class="mb-3">
                                <label for="load" class="form-label">Load</label>
                                <input type="number" class="form-control" id="load" name="load" required>
                            </div>
                            <div class="mb-3">
                                <label for="inBatteryBrand" class="form-label">Battery Brand</label>
                                <select id="inBatteryBrand" class="form-select single-select" name="battery_brand"">
                                    <option value="">--</option>
                                    <option value="Brand A">Brand A</option>
                                    <option value="Brand B">Brand B</option>
                                    <option value="Brand C">Brand C</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inBatteryType" class="form-label">Battery Type</label>
                                <select id="inBatteryType" class="form-select single-select" name="battery_type">
                                    <option value=""></option>
                                    <option value="Lithium">Lithium</option>
                                    <option value="VRLA">VRLA</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="batteryQuantity">Battery Quantity</label>
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
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="battery_status">
                                    <option selected hidden>Battery Status</option>
                                    <option value="Good">Good</option>
                                    <option value="Degraded">Degraded</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="backup_time" class="form-label">Backup Time</label>
                                <input type="number" class="form-control" id="backup_time" name="backup_time" required>
                            </div>
                            <label for="id_equipment" class="form-label">Equipment</label>
                            <select class="multiple-select" id="id_equipment" name="id_equipment[]" multiple="multiple"
                                required>
                                @foreach ($equipments as $equip)
                                    <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                                @endforeach
                            </select>
                            <br/>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

                <script>
                    const steps = document.querySelectorAll('.form-step');
                    const nextBtns = document.querySelectorAll('.next-step');
                    const prevBtns = document.querySelectorAll('.prev-step');
                    let currentStep = 0;

                    nextBtns.forEach(btn => {
                        btn.addEventListener('click', () => {
                            steps[currentStep].classList.add('d-none');
                            currentStep++;
                            steps[currentStep].classList.remove('d-none');
                        });
                    });

                    prevBtns.forEach(btn => {
                        btn.addEventListener('click', () => {
                            steps[currentStep].classList.add('d-none');
                            currentStep--;
                            steps[currentStep].classList.remove('d-none');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
