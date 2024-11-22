@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="container mt-5">
                <form id="multi-step-form" action="{{ route('rectifier.update', $rectifier->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Step 1: Site Information -->
                    <div class="form-step">
                        <h4>Step 1: Site Information</h4>
                        <div class="mb-3">
                            <label for="selectSite" class="form-label">Site ID</label>
                            <select class="form-select" id="selectSite" name="id_site" required>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}" {{ $rectifier->id_site == $site->id ? 'selected' : '' }}>
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
                            <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                            <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="{{ $rectifier->id_pelanggan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="daya" class="form-label">Daya PLN (kVA)</label>
                            <input type="number" class="form-control" id="daya" name="daya" value="{{ $rectifier->daya }}" step="0.1" required>
                        </div>
                        <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                        <button type="button" class="btn btn-info prev-step">Previous</button>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <!-- Step 3: Rectifier Information -->
                    <div class="form-step d-none">
                        <h4>Step 3: Rectifier and Battery Information</h4>
                        <div class="mb-3">
                            <label for="recti_name" class="form-label">Rectifier Name</label>
                            <input type="text" class="form-control" id="recti_name" name="recti_name" value="{{ $rectifier->recti_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="recti_brand" class="form-label">Rectifier Brand</label>
                            <select id="recti_brand" name="recti_brand" class="form-select" required>
                                <option value="Emerson" {{ $rectifier->recti_brand == 'Emerson' ? 'selected' : '' }}>Emerson</option>
                                <option value="Hariff" {{ $rectifier->recti_brand == 'Hariff' ? 'selected' : '' }}>Hariff</option>
                                <option value="Vertiv" {{ $rectifier->recti_brand == 'Vertiv' ? 'selected' : '' }}>Vertiv</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="apr_quantity" class="form-label">APR Quantity</label>
                            <input type="number" class="form-control" id="apr_quantity" name="apr_quantity" value="{{ $rectifier->apr_quantity }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bus_voltage" class="form-label">Bus Voltage (V)</label>
                            <input type="number" class="form-control" id="bus_voltage" name="bus_voltage" value="{{ $rectifier->bus_voltage }}" step="0.1" required>
                        </div>
                        <div class="mb-3">
                            <label for="load" class="form-label">Load (A)</label>
                            <input type="number" class="form-control" id="load" name="load" value="{{ $rectifier->load }}" step="0.1" required>
                        </div>
                        <div class="mb-3">
                            <label for="inBatteryBrand" class="form-label">Battery Brand</label>
                            <select id="inBatteryBrand" class="form-select single-select" name="battery_brand">
                                <option value="">--</option>
                                <option value="Sacredsun"
                                    {{ old('battery_brand', $rectifier->battery_brand) == 'Sacredsun' ? 'selected' : '' }}>
                                    Sacredsun</option>
                                <option value="ZTE"
                                    {{ old('battery_brand', $rectifier->battery_brand) == 'ZTE' ? 'selected' : '' }}>
                                    ZTE</option>
                                <option value="Sonneinchen"
                                    {{ old('battery_brand', $rectifier->battery_brand) == 'Sonneinchen' ? 'selected' : '' }}>
                                    Sonneinchen</option>
                                <option value="Maxlife"
                                    {{ old('battery_brand', $rectifier->battery_brand) == 'Maxlife' ? 'selected' : '' }}>
                                    Maxlife</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="inBatteryType" class="form-label">Battery Type</label>
                            <select id="inBatteryType" class="form-select single-select" name="battery_type">
                                <option value="">--</option>
                                <option
                                    value="Lithium"{{ old('battery_type', $rectifier->battery_type) == 'Lithium' ? 'selected' : '' }}>
                                    Lithium</option>
                                <option value="VRLA"
                                    {{ old('battery_type', $rectifier->battery_type) == 'VRLA' ? 'selected' : '' }}>
                                    VRLA</option>
                            </select>
                        </div>

                        <!-- Battery Section -->
                        <div id="battery-section">
                            <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                            @foreach ($rectifier->batteries as $battery)
                                <div class="input-group mb-3 battery-fields">
                                    <select class="form-select" name="battery_quantity[]"
                                        aria-describedby="button-addon2">
                                        <option value="0"
                                        {{ $battery->battery_quantity == 0 ? 'selected' : '' }}>0</option>
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
                                        <option value="Stolen"
                                        {{ $battery->battery_status == 'Stolen' ? 'selected' : '' }}>Stolen
                                        </option>
                                    </select>
                                    <button type="button" class="btn btn-outline-danger remove-battery-btn">Remove Battery</button>
                                </div>
                            @endforeach

                            <!-- Button to add new battery fields -->
                            <div class="input-group mb-3">
                                <button class="btn btn-outline-secondary" type="button" id="add-battery-btn">Add
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

                        <!-- Image Section -->
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
                            <small class="form-text text-muted">Please upload an image captured with a camera that includes a timestamp.</small>
                            <input name="image" type="file" accept="image/png, image/jpeg" class="form-control">
                        </div>
                        <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                        <button type="button" class="btn btn-info prev-step">Previous</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        // Handle steps navigation
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

        // Add battery functionality
        document.getElementById('add-battery-btn').addEventListener('click', () => {
            const batterySection = document.getElementById('battery-section');
            const newBattery = document.createElement('div');
            newBattery.classList.add('input-group', 'mb-3', 'battery-fields');
            newBattery.innerHTML = `
                <select class="form-select" name="battery_quantity[]" required>
                    @for ($i = 0; $i <= 8; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <select class="form-select" name="battery_status[]" required>
                    <option value="Good">Good</option>
                    <option value="Degraded">Degraded</option>
                    <option value="Stolen">Stolen</option>
                </select>
                <button type="button" class="btn btn-outline-danger remove-battery-btn">Remove</button>
            `;
            batterySection.appendChild(newBattery);

            // Add remove functionality
            newBattery.querySelector('.remove-battery-btn').addEventListener('click', () => {
                newBattery.remove();
            });
        });

        // Remove existing batteries
        document.querySelectorAll('.remove-battery-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.closest('.battery-fields').remove();
            });
        });
    </script>
</div>
@endsection
