@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('rectifier.update', $rectifier->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Step 1: Site Information -->
                        <div class="form-step">
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="form-select single-select" id="selectSite" name="id_site"
                                    aria-label="Default select example">
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}"
                                            {{ old('id_site', $rectifier->id_site ?? '') == $site->id ? 'selected' : '' }}>
                                            {{ $site->site_id }} - {{ $site->site_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 2: Customer Information -->
                        <div class="form-step d-none">
                            <h4>Step 2: Customer Information</h4>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">Customer ID</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan"
                                    value="{{ old('id_pelanggan', $rectifier->id_pelanggan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="daya" class="form-label">Power (Daya)</label>
                                <input type="number" class="form-control" id="daya" name="daya" step="0.1"
                                    value="{{ old('daya', $rectifier->daya) }}" required>
                            </div>
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                            <button type="button" class="btn btn-info prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 3: Rectifier and Battery Information -->
                        <div class="form-step d-none">
                            <h4>Step 3: Rectifier and Battery Information</h4>
                            <div class="mb-3">
                                <label for="recti_name" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" id="recti_name" name="recti_name"
                                    value="{{ old('recti_name', $rectifier->recti_name) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="inRectiBrand" class="form-label">Rectifier Brand</label>
                                <select id="inRectiBrand" name="recti_brand" class="form-select single-select">
                                    <option value="">--</option>
                                    <option value="Emerson"
                                        {{ old('recti_brand', $rectifier->recti_brand) == 'Emerson' ? 'selected' : '' }}>
                                        Emerson</option>
                                    <option value="Hariff"
                                        {{ old('recti_brand', $rectifier->recti_brand) == 'Hariff' ? 'selected' : '' }}>
                                        Hariff</option>
                                    <option value="Vertiv"
                                        {{ old('recti_brand', $rectifier->recti_brand) == 'Vertiv' ? 'selected' : '' }}>
                                        Vertiv</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="inAprQuantity">APR Quantity</label>
                                <select class="form-select single-select" id="inAprQuantity" name="apr_quantity">
                                    <option value="">--</option>
                                    <option value="1"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '1' ? 'selected' : '' }}>1
                                    </option>
                                    <option value="2"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '2' ? 'selected' : '' }}>2
                                    </option>
                                    <option value="3"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '3' ? 'selected' : '' }}>3
                                    </option>
                                    <option value="4"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '4' ? 'selected' : '' }}>4
                                    </option>
                                    <option value="5"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '5' ? 'selected' : '' }}>5
                                    </option>
                                    <option value="6"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '6' ? 'selected' : '' }}>6
                                    </option>
                                    <option value="7"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '7' ? 'selected' : '' }}>7
                                    </option>
                                    <option value="8"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '8' ? 'selected' : '' }}>8
                                    </option>
                                    <option value="9"
                                        {{ old('apr_quantity', $rectifier->apr_quantity) == '9' ? 'selected' : '' }}>9
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bus_voltage" class="form-label">Bus Voltage</label>
                                <input type="number" class="form-control" id="bus_voltage" name="bus_voltage"
                                    step="0.1" value="{{ old('bus_voltage', $rectifier->bus_voltage) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="load" class="form-label">Load</label>
                                <input type="number" class="form-control" id="load" name="load" step="0.1"
                                    value="{{ old('load', $rectifier->load) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="inBatteryBrand" class="form-label">Battery Brand</label>
                                <select id="inBatteryBrand" class="form-select single-select" name="battery_brand">
                                    <option value="">--</option>
                                    <option value="Brand A"
                                        {{ old('battery_brand', $rectifier->battery_brand) == 'Brand A' ? 'selected' : '' }}>
                                        Brand A</option>
                                    <option value="Brand B"
                                        {{ old('battery_brand', $rectifier->battery_brand) == 'Brand B' ? 'selected' : '' }}>
                                        Brand B</option>
                                    <option value="Brand C"
                                        {{ old('battery_brand', $rectifier->battery_brand) == 'Brand C' ? 'selected' : '' }}>
                                        Brand C</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="inBatteryType" class="form-label">Battery Type</label>
                                <select id="inBatteryType" class="form-select single-select" name="battery_type">
                                    <option value=""></option>
                                    <option
                                        value="Lithium"{{ old('battery_type', $rectifier->battery_type) == 'Lithium' ? 'selected' : '' }}>
                                        Lithium</option>
                                    <option value="VRLA"
                                        {{ old('battery_type', $rectifier->battery_type) == 'VRLA' ? 'selected' : '' }}>
                                        VRLA</option>
                                </select>
                            </div>
                            <div id="battery-section">
                                <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                                @foreach ($rectifier->batteries as $battery)
                                    <div class="input-group mb-3 battery-fields">
                                        <select class="form-select" name="battery_quantity[]"
                                            aria-describedby="button-addon2">
                                            <option value="1"
                                                {{ $battery->battery_quantity == 1 ? 'selected' : '' }}>1</option>
                                            <option value="2"
                                                {{ $battery->battery_quantity == 2 ? 'selected' : '' }}>2</option>
                                            <option value="3"
                                                {{ $battery->battery_quantity == 3 ? 'selected' : '' }}>3</option>
                                            <option value="4"
                                                {{ $battery->battery_quantity == 4 ? 'selected' : '' }}>4</option>
                                            <option value="5"
                                                {{ $battery->battery_quantity == 5 ? 'selected' : '' }}>5</option>
                                            <option value="6"
                                                {{ $battery->battery_quantity == 6 ? 'selected' : '' }}>6</option>
                                            <option value="7"
                                                {{ $battery->battery_quantity == 7 ? 'selected' : '' }}>7</option>
                                            <option value="8"
                                                {{ $battery->battery_quantity == 8 ? 'selected' : '' }}>8</option>
                                        </select>
                                        <select class="form-select" name="battery_status[]">
                                            <option value="Good"
                                                {{ $battery->battery_status == 'Good' ? 'selected' : '' }}>Good</option>
                                            <option value="Degraded"
                                                {{ $battery->battery_status == 'Degraded' ? 'selected' : '' }}>Degraded
                                            </option>
                                        </select>
                                        <button type="button" class="btn btn-outline-danger remove-battery">Remove
                                            Battery</button>
                                    </div>
                                @endforeach

                                <!-- Button to add new battery fields -->
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add
                                        Battery</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="backup_time" class="form-label">Backup Time</label>
                                <input type="number" class="form-control" id="backup_time" name="backup_time"
                                    value="{{ old('backup_time', $rectifier->backup_time) }}" required>
                            </div>
                            <div class="mb3">
                                <label for="id_equipment" class="form-label">Equipment</label>
                                <select class="multiple-select" id="id_equipment" name="id_equipment[]"
                                    multiple="multiple" required>
                                    @foreach ($equipments as $equip)
                                        <option value="{{ $equip->id }}"
                                            {{ in_array($equip->id, old('id_equipment', $rectifier->equipments->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                                            {{ $equip->equipment_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="current_image" class="form-label">Current Image</label>
                                <div>
                                    @if ($rectifier->image)
                                        <img src="{{ asset('images/' . $rectifier->image) }}"
                                            alt="Current Rectifier Image" class="img-fluid mb-2"
                                            style="max-width: 200px;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload New Image</label>
                                <input name="image" id="image-uploadify" type="file" accept="image" multiple>
                            </div>
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                            <button type="button" class="btn btn-info prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#image-uploadify').imageuploadify();
                    })
                </script>

                <script>
                    // Multi-step navigation
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

                    // AJAX to handle rectifier name based on site selection
                    document.getElementById('selectSite').addEventListener('change', function() {
                        const siteId = this.value;

                        if (siteId) {
                            fetch(`/api/site/${siteId}/rectifiers-count`)
                                .then(response => response.json())
                                .then(data => {
                                    const rectifierCount = data.count;
                                    const rectifierName = `Rectifier ${rectifierCount + 1}`;
                                    document.getElementById('recti_name').value = rectifierName;
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            document.getElementById('recti_name').value = ''; // Reset if no site selected
                        }
                    });

                    document.getElementById('button-addon2').addEventListener('click', function() {
                        const batterySection = document.getElementById('battery-section');

                        // Create a new battery input group with quantity and status
                        const newField = document.createElement('div');
                        newField.classList.add('input-group', 'mb-3', 'battery-fields');
                        newField.innerHTML = `
        <select class="form-select" name="battery_quantity[]" aria-describedby="button-addon2">
            <option selected>Choose...</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>
        <select class="form-select" name="battery_status[]">
            <option selected hidden>Battery Status</option>
            <option value="Good">Good</option>
            <option value="Degraded">Degraded</option>
        </select>
        <button type="button" class="btn btn-outline-danger remove-battery">Remove Battery</button>
    `;

                        batterySection.appendChild(newField);

                        // Add event listener to remove button
                        newField.querySelector('.remove-battery').addEventListener('click', function() {
                            newField.remove();
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
