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
                                <option value="{{ $site->id }}" {{ $rectifier->id_site == $site->id ? 'selected' : '' }}>
                                    {{ $site->site_id }} - {{ $site->site_name }}
                                </option>
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
                            <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="{{ $kwhMeter->id_pelanggan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="daya" class="form-label">Daya PLN (kVA)</label>
                            <input type="number" class="form-control" id="daya" name="daya" value="{{ $kwhMeter->daya }}" step="0.1" required>
                        </div>
                        <div class="mb-3">
                            <label for="kondisi_kwh" class="form-label">Kondisi KWh Meter</label>
                            <select id="kondisi_kwh" class="form-select single-select" name="kondisi_kwh">
                                <option value="">--</option>
                                <option
                                    value="Bagus"{{ old('kondisi_kwh', $kwhMeter->kondisi_kwh) == 'Bagus' ? 'selected' : '' }}>
                                    Bagus</option>
                                <option value="Terbakar"
                                    {{ old('kondisi_kwh', $kwhMeter->kondisi_kwh) == 'Terbakar' ? 'selected' : '' }}>
                                    Terbakar</option>
                                <option value="Bypass"
                                {{ old('kondisi_kwh', $kwhMeter->kondisi_kwh) == 'Bypass' ? 'selected' : '' }}>
                                Bypass</option>
                            </select>                         
                        </div>
                        <div class="mb-3">
                            <label for="arusPln" class="form-label">Arus (A) PLN</label>
                            <input type="number" class="form-control" id="arusPln" name="arus_pln" value="{{ $kwhMeter->arus_pln }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phasa1" class="form-label">Phasa 1 (V)</label>
                            <input type="number" class="form-control" id="phasa1" name="phasa_1" value="{{ $kwhMeter->phasa_1 }}">
                        </div>
                        <div class="mb-3">
                            <label for="phasa2" class="form-label">Phasa 2 (V)</label>
                            <input type="number" class="form-control" id="phasa2" name="phasa_2" value="{{ $kwhMeter->phasa_2 }}">
                        </div>
                        <div class="mb-3">
                            <label for="phasa3" class="form-label">Phasa 3 (V)</label>
                            <input type="number" class="form-control" id="phasa3" name="phasa_3" value="{{ $kwhMeter->phasa_3 }}">
                        </div>
                        <div class="mb-3">
                            <label for="current_kwh_image" class="form-label">Current KWh Image</label>
                            <div>
                                @if ($kwhMeter->foto_kwh)
                                <img src="{{ Storage::url($kwhMeter->foto_kwh) }}" 
                                     alt="Current KWh Image" 
                                     class="img-fluid mb-2" 
                                     style="max-width: 200px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto_kwh" class="form-label">Upload KWh Image</label>
                            <small class="form-text text-muted">Foto Tampak Depan KWh</small>
                            <input type="file" class="form-control" name="foto_kwh" accept="image/*">                        
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
                            <input type="text" class="form-control" id="recti_name" name="recti_name" value="{{ old('recti_name', $rectifier->recti_name ?? '') }}" readonly>
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
                            <label for="battery_brand" class="form-label">Battery Brand</label>
                            <select id="battery_brand" class="form-select single-select" name="battery_brand">
                                <option disabled>-- Choose --</option>
                                @foreach ($batterybrand as $batteryBrand)
                                    <option value="{{ $batteryBrand->id }}" 
                                        {{ $rectifier->battery_brand == $batteryBrand->id ? 'selected' : '' }}>
                                        {{ $batteryBrand->battery_brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="battery_type" class="form-label">Battery Type</label>
                            <select id="battery_type" class="form-select single-select" name="battery_type">
                                <option value="">--</option>
                                <option
                                    value="Lithium"{{ old('battery_type', $rectifier->batterytype->battery_type) == 'Lithium' ? 'selected' : '' }}>
                                    Lithium</option>
                                <option value="VRLA"
                                    {{ old('battery_type', $rectifier->batterytype->battery_type) == 'VRLA' ? 'selected' : '' }}>
                                    VRLA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="total_battery" class="form-label">Total Battery (Unit/Pack)</label>
                            <input type="number" class="form-control" id="total_battery" name="total_battery" value="{{ $rectifier->total_battery }}" step="0.1" required>
                        </div>
                        <!-- Battery Section -->
                        <div id="battery-section">
                            @foreach ($rectifier->batteries as $index => $battery)
                            <label class="form-label" for="battery_quantity[{{ $index }}]">Battery Quantity</label>
                                <div class="input-group mb-3 battery-fields" data-index="{{ $index }}">
                                    <input type="number" class="form-control" id="battery_quantity[{{ $index }}]" name="battery_quantity[{{ $index }}]" value="{{ $battery->battery_quantity }}" step="0.1" required>
                                    <select class="form-select" name="battery_status[{{ $index }}]" id="battery_status[{{ $index }}]">
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
                                <button class="btn btn-outline-secondary" type="button" id="add-battery-btn" data-index="${index}">Add
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
                                <img src="{{ Storage::url($rectifier->image) }}" 
                                     alt="Current Rectifier Image" 
                                     class="img-fluid mb-2" 
                                     style="max-width: 200px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Upload New Image</label>
                            <small class="form-text text-muted">Foto Tampak Depan Rectifier dengan Pintu Terbuka</small>
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
                <input type="number" class="form-control" id="battery_quantity[${index}]" name="battery_quantity[${index}]" step="0.1" required>
                <select class="form-select" name="battery_status[${index}]" required>
                    <option value="Good">Good</option>
                    <option value="Degraded">Degraded</option>
                    <option value="Stolen">Stolen</option>
                </select>
                <button type="button" class="btn btn-outline-danger remove-battery-btn">Remove Battery</button>
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
