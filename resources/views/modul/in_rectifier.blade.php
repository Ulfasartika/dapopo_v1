@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('rectifier.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1: Site Information -->
                        <div class="form-step"> <!-- Step 1 -->
                            <h4>Step 1: Site Information</h4>
                            <!-- Label for the Site ID selection dropdown -->
                            <label for="selectSite" class="form-label">Site ID</label>

                            <!-- Dropdown for selecting a Site ID -->
                            <select class="single-select" id="selectSite" name="id_site" required>
                                <option disabled selected hidden>-- Select Site --</option>
                                @foreach ($sites as $site)
                                    <!-- Option for each site -->
                                    <option value="{{ $site->id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                @endforeach
                            </select>

                            <!-- Display validation errors if any -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- Cancel button to go back to the rectifier index page -->
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary">Cancel</a>

                            <!-- Button to proceed to the next step -->
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Hidden div for the next form step -->
                        <div class="form-step d-none"> <!-- Step 3 -->
                            <h4>Step 2: Jumlah Rectifier</h4>
                            <div class="mb-3">
                                <label for="num_rectifiers" class="form-label">Masukkan Jumlah Rectifier</label>
                                <input type="number" class="form-control" id="num_rectifiers" name="num_rectifiers" min="1" required>
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
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step" id="generate-rectifier-forms">Next</button>
                        </div>

                        <div class="form-step d-none"> <!-- Step 4 -->
                            <h4>Step 3: Rectifier and Battery Information</h4>
                            <div id="rectifier-section"></div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

                <script>
                    const steps = document.querySelectorAll('.form-step');
                    let currentStep = 0;
                    let rectifierCount = 0;
                
                    // Navigate Next
                    document.querySelectorAll('.next-step').forEach(button => {
                        button.addEventListener('click', () => {
                            if (validateStep(currentStep)) {
                                steps[currentStep].classList.add('d-none');
                                currentStep++;
                                steps[currentStep].classList.remove('d-none');
                                console.log(`Moved to Step ${currentStep + 1}`);
                            } else {
                                alert('Please complete all required fields.');
                            }
                        });
                    });
                
                    // Navigate Previous
                    document.querySelectorAll('.prev-step').forEach(button => {
                        button.addEventListener('click', () => {
                            steps[currentStep].classList.add('d-none');
                            currentStep--;
                            steps[currentStep].classList.remove('d-none');
                            console.log(`Moved back to Step ${currentStep + 1}`);
                        });
                    });
                
                    // Validation Function
                    function validateStep(stepIndex) {
                        if (stepIndex === 0) {
                            return document.getElementById('selectSite').value !== '';
                        }

                        if (stepIndex === 1) {
                            const numRectifiers = parseInt(document.getElementById('num_rectifiers').value, 10);
                            return !isNaN(numRectifiers) && numRectifiers > 0;
                        }
                        return true;
                    }
                
                    // Fetch Rectifier Count
                    document.getElementById('selectSite').addEventListener('change', function () {
                    const siteId = this.value;
                    if (siteId) {
                        fetch(`/api/site/${siteId}/rectifiers-count`)
                            .then(response => response.json())
                            .then(data => {
                                rectifierCount = data.count || 0;
                                console.log(`Existing Rectifiers: ${rectifierCount}`);
                            })
                            .catch(error => console.error('Error fetching rectifier count:', error));
                    } else {
                        rectifierCount = 0;
                    }
                });
                
            document.getElementById('generate-rectifier-forms').addEventListener('click', function () {
            const rectifierSection = document.getElementById('rectifier-section');
            const numRectifiers = parseInt(document.getElementById('num_rectifiers').value, 10);

            if (isNaN(numRectifiers) || numRectifiers <= 0) {
                alert('Please enter a valid number of rectifiers.');
                return;
            }

            rectifierSection.innerHTML = '';

            for (let i = 0; i < numRectifiers; i++) {
                const rectifierIndex = rectifierCount + i + 1;
                const newRectifierForm = `
                    <div class="rectifier-form mb-4">
                        <h5>Rectifier ${rectifierIndex}</h5>

                        <!-- Rectifier Name -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][recti_name]" class="form-label">Rectifier Name</label>
                            <input type="text" class="form-control" name="rectifiers[${i}][recti_name]" value="Rectifier ${rectifierIndex}" readonly>
                        </div>

                        <!-- Rectifier Brand -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][recti_brand]" class="form-label">Rectifier Brand</label>
                            <select name="rectifiers[${i}][recti_brand]" class="form-select">
                                <option disabled selected hidden>-- Select Brand --</option>
                                <option value="Emerson">Emerson</option>
                                <option value="Hariff">Hariff</option>
                                <option value="Vertiv">Vertiv</option>
                            </select>
                        </div>

                        <!-- APR Quantity -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][apr_quantity]" class="form-label">APR Quantity</label>
                            <select class="form-select" name="rectifiers[${i}][apr_quantity]">
                                <option disabled selected hidden>-- Select Qty --</option>
                                <option value="0">0</option>
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

                        <!-- Bus Voltage -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][bus_voltage]" class="form-label">Bus Voltage (V)</label>
                            <input type="number" class="form-control" name="rectifiers[${i}][bus_voltage]" min="40" max="80">
                        </div>
                        

                        <!-- Load -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][load]" class="form-label">Load (A)</label>
                            <input type="number" class="form-control" name="rectifiers[${i}][load]" min="0" max="200">
                        </div>

                        <!-- Battery Brand -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][battery_brand]" class="form-label">Battery Brand</label>
                            <select name="rectifiers[${i}][battery_brand]" class="form-select" placeholder="Choose">
                                @foreach ($batterybrand as $battery_brand)
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="{{ $battery_brand->id }}">{{ $battery_brand->battery_brand }}</option>
                                @endforeach
                            </select>
                        </div>

                <!-- Battery Type -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][battery_type]" class="form-label">Battery Type</label>
                    <select name="rectifiers[${i}][battery_type]" class="form-select battery-type-select" data-index="${i}">
                    <option disabled selected hidden>-- Choose --</option>
                    @foreach ($batterytype as $battery_type)
                        <option value="{{ $battery_type['battery_type'] }}">{{ $battery_type['battery_type'] }}</option>
                    @endforeach                  
                    </select>
                </div>
                <!-- Total Battery -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][total_battery]" class="form-label">
                        Total Battery (<span id="battery-unit-${i}">Unit</span>)
                    </label>
                    <input type="number" class="form-control" name="rectifiers[${i}][total_battery]">
                </div>
                <div class="mb-3">
                    <label for="rectifiers[${i}][good_battery]" class="form-label">
                        Good Battery (<span id="battery-unit-${i}">Unit</span>)
                    </label>
                    <input type="number" class="form-control" name="rectifiers[${i}][good_battery]">
                </div>
                <div class="mb-3">
                    <label for="rectifiers[${i}][degraded_battery]" class="form-label">
                        Degraded Battery (<span id="battery-unit-${i}">Unit</span>)
                    </label>
                    <input type="number" class="form-control" name="rectifiers[${i}][degraded_battery]">
                </div>
                <div class="mb-3">
                    <label for="rectifiers[${i}][stolen_battery]" class="form-label">
                        Stolen Battery (<span id="battery-unit-${i}">Unit</span>)
                    </label>
                    <input type="number" class="form-control" name="rectifiers[${i}][stolen_battery]">
                </div>

                        <!-- Backup Time -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][backup_time]" class="form-label">Backup Time (Hour)</label>
                            <input type="number" class="form-control" name="rectifiers[${i}][backup_time]" min="0" max="8">
                        </div>

                        <!-- Equipment -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][id_equipment]" class="form-label">Equipment</label>
                            <select class="multiple-select" name="rectifiers[${i}][id_equipment][]" multiple>
                                @foreach ($equipments as $equip)
                                    <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Upload Image -->
                        <div class="mb-3">
                            <label for="rectifiers[${i}][image]" class="form-label">Upload Image</label>
                            <br>
                            <small>Foto tampak depan rectifier dengan pintu terbuka</small>
                            <input type="file" name="rectifiers[${i}][image]" accept="image/png, image/jpeg" class="form-control">
                        </div>
                    </div>
                `;
                rectifierSection.innerHTML += newRectifierForm;
            }


    // Reinitialize Select2 for All New Elements
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Select Equipment',
        allowClear: true,
    });
});

        document.getElementById('rectifier-section').addEventListener('change', function (event) {
        if (event.target && event.target.classList.contains('battery-type-select')) {
            const index = event.target.getAttribute('data-index');
            const unitElement = document.getElementById(`battery-unit-${index}`);
            const quantityField = document.getElementById(`battery-quantity-${index}`);

            // Get the selected battery type
            const selectedBatteryType = event.target.value.trim().toLowerCase();

            // Determine unit based on battery type
            let unit = '';
            if (selectedBatteryType === 'lithium') {
                unit = 'Pack';
            } else if (selectedBatteryType === 'vrla') {
                unit = 'Unit';
            }

            // Update Total Battery Unit
            if (unitElement) {
                unitElement.textContent = unit;
            }
        }
        });
                </script>
            </div>
        </div>
    </div>
@endsection
