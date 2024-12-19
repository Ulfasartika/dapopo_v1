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
                                <select class="single-select" id="selectSite" name="id_site" required>
                                    <option value="{{ $site->id }}"
                                        {{ $rectifier->id_site == $site->id ? 'selected' : '' }}>
                                        {{ $site->site_id }} - {{ $site->site_name }}
                                    </option>
                                </select>
                            </div>
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 2: Rectifier Information -->
                        <div class="form-step d-none">
                            <h4>Step 3: Rectifier and Battery Information</h4>
                            <div class="mb-3">
                                <label for="recti_name" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" id="recti_name" name="recti_name"
                                    value="{{ old('recti_name', $rectifier->recti_name ?? '') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="recti_brand" class="form-label">Rectifier Brand</label>
                                <select id="recti_brand" name="recti_brand" class="form-select" required>
                                    <option value="Emerson" {{ $rectifier->recti_brand == 'Emerson' ? 'selected' : '' }}>
                                        Emerson</option>
                                    <option value="Hariff" {{ $rectifier->recti_brand == 'Hariff' ? 'selected' : '' }}>
                                        Hariff</option>
                                    <option value="Vertiv" {{ $rectifier->recti_brand == 'Vertiv' ? 'selected' : '' }}>
                                        Vertiv</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="apr_quantity" class="form-label">APR Quantity</label>
                                <input type="number" class="form-control" id="apr_quantity" name="apr_quantity"
                                    value="{{ $rectifier->apr_quantity }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="bus_voltage" class="form-label">Bus Voltage (V)</label>
                                <input type="number" class="form-control" id="bus_voltage" name="bus_voltage"
                                    value="{{ $rectifier->bus_voltage }}" min="40" max="80" required>
                            </div>
                            <div class="mb-3">
                                <label for="load" class="form-label">Load (A)</label>
                                <input type="number" class="form-control" id="load" name="load"
                                    value="{{ $rectifier->load }}" min="0" max="200" required>
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
                                <input type="number" class="form-control" id="total_battery" name="total_battery"
                                    value="{{ $rectifier->total_battery }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="good_battery" class="form-label">Good Battery (Unit/Pack)</label>
                                <input type="number" class="form-control" id="good_battery" name="good_battery"
                                    value="{{ $rectifier->good_battery }}">
                            </div>
                            <div class="mb-3">
                                <label for="degraded_battery" class="form-label">Degraded Battery (Unit/Pack)</label>
                                <input type="number" class="form-control" id="degraded_battery" name="degraded_battery"
                                    value="{{ $rectifier->degraded_battery }}">
                            </div>
                            <div class="mb-3">
                                <label for="stolen_battery" class="form-label">Stolen Battery (Unit/Pack)</label>
                                <input type="number" class="form-control" id="stolen_battery" name="stolen_battery"
                                    value="{{ $rectifier->stolen_battery }}">
                            </div>          
                            <div class="mb-3">
                                <label for="backup_time" class="form-label">Backup Time</label>
                                <input type="number" class="form-control" id="backup_time" name="backup_time"
                                    value="{{ old('backup_time', $rectifier->backup_time) }}" min="0" max="8" required>
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
                                        <img src="{{ Storage::url($rectifier->image) }}" alt="Current Rectifier Image"
                                            class="img-fluid mb-2" style="max-width: 200px;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload New Image</label>
                                <small class="form-text text-muted">Foto Tampak Depan Rectifier dengan Pintu
                                    Terbuka</small>
                                <input name="image" type="file" accept="image/png, image/jpeg"
                                    class="form-control">
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
            let batteryIndex = 0; // Initialize battery index

            document.getElementById('add-battery-btn').addEventListener('click', function() {
                const batterySection = document.getElementById('battery-section');
                const index = batterySection.querySelectorAll('.battery-fields').length;

                const newField = `
        <div class="input-group mb-3 battery-fields" data-index="${index}">
            <input type="number" class="form-control" name="battery_quantity[${index}]" step="0.1" required>
            <select class="form-select" name="battery_status[${index}]">
                <option value="Good">Good</option>
                <option value="Degraded">Degraded</option>
                <option value="Stolen">Stolen</option>
            </select>
            <button type="button" class="btn btn-outline-danger remove-battery-btn">Remove Battery</button>
        </div>
    `;
                batterySection.insertAdjacentHTML('beforeend', newField);
            });

            // Remove battery fields
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-battery-btn')) {
                    event.target.closest('.battery-fields').remove();
                }
                $('.multiple-select').select2({
                    theme: 'bootstrap4',
                    width: '100%',
                    placeholder: 'Select Equipment',
                    allowClear: true,
                });

            });

            // Remove existing batteries
            document.querySelectorAll('.remove-battery-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.closest('.battery-fields').remove();
                });
            });
        </script>
    </div>
@endsection
