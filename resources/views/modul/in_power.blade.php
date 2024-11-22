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
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="form-select" id="selectSite" name="id_site" required>
                                    <option hidden value="">-- Select Site --</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                    @endforeach
                                </select>
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
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <div class="form-step d-none"> <!-- Step 2 -->
                            <h4>Step 2: PLN Information</h4>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <label for="daya" class="form-label">Daya PLN (kvA)</label>
                                <input type="number" class="form-control" id="daya" name="daya" step="0.1" required>
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
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <div class="form-step d-none"> <!-- Step 3 -->
                            <h4>Step 3: Number of Rectifiers</h4>
                            <div class="mb-3">
                                <label for="num_rectifiers" class="form-label">Number of Rectifiers</label>
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
                            <h4>Step 4: Rectifier and Battery Information</h4>
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
                            const idPelanggan = document.getElementById('id_pelanggan').value.trim();
                            const daya = document.getElementById('daya').value;
                            return idPelanggan !== '' && parseFloat(daya) > 0;
                        }
                        if (stepIndex === 2) {
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
                
                    // Generate Rectifier Forms
                    document.getElementById('generate-rectifier-forms').addEventListener('click', function () {
    const rectifierSection = document.getElementById('rectifier-section');
    const numRectifiers = parseInt(document.getElementById('num_rectifiers').value, 10);

    if (isNaN(numRectifiers) || numRectifiers <= 0) {
        alert('Please enter a valid number of rectifiers.');
        return;
    }

    rectifierSection.innerHTML = ''; // Clear old forms

    for (let i = 0; i < numRectifiers; i++) {
        const rectifierIndex = i + 1; // Start from 1 for display
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
                        <option hidden value="">-- Select Brand --</option>
                        <option value="Emerson">Emerson</option>
                        <option value="Hariff">Hariff</option>
                        <option value="Vertiv">Vertiv</option>
                    </select>
                </div>

                <!-- APR Quantity -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][apr_quantity]" class="form-label">APR Quantity</label>
                    <select class="form-select" name="rectifiers[${i}][apr_quantity]">
                        <option hidden>-- Select Qty --</option>
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
                    <input type="number" class="form-control" name="rectifiers[${i}][bus_voltage]" step="0.1">
                </div>

                <!-- Load -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][load]" class="form-label">Load (A)</label>
                    <input type="number" class="form-control" name="rectifiers[${i}][load]" step="0.1">
                </div>

                <!-- Battery Brand -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][battery_brand]" class="form-label">Battery Brand</label>
                    <select name="rectifiers[${i}][battery_brand]" class="form-select">
                        <option hidden>-- Select Brand --</option>
                        <option value="Sacredsun">Sacredsun</option>
                        <option value="ZTE">ZTE</option>
                        <option value="Sonneinchen">Sonneinchen</option>
                        <option value="Maxlife">Maxlife</option>
                    </select>
                </div>

                <!-- Battery Type -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][battery_type]" class="form-label">Battery Type</label>
                    <select name="rectifiers[${i}][battery_type]" class="form-select">
                        <option hidden>-- Select Type --</option>
                        <option value="Lithium">Lithium</option>
                        <option value="VRLA">VRLA</option>
                    </select>
                </div>

                <!-- Battery Section -->
                <div id="battery-section-${i}">
                    <label class="form-label" for="rectifiers[${i}][battery_quantity]">Battery Quantity</label>
                    <div class="input-group mb-3 battery-fields">
                        <select class="form-select" name="rectifiers[${i}][battery_quantity][]">
                            <option hidden>-- Battery Qty --</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <select class="form-select" name="rectifiers[${i}][battery_status][]">
                            <option hidden>Battery Status</option>
                            <option value="Good">Good</option>
                            <option value="Degraded">Degraded</option>
                            <option value="Stolen">Stolen</option>
                        </select>
                        <button class="btn btn-outline-secondary add-battery-btn" type="button" data-index="${i}">Add Battery</button>
                    </div>
                </div>

                <!-- Backup Time -->
                <div class="mb-3">
                    <label for="rectifiers[${i}][backup_time]" class="form-label">Backup Time (Hour)</label>
                    <input type="number" class="form-control" name="rectifiers[${i}][backup_time]">
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


document.addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('add-battery-btn')) {
        const rectifierIndex = event.target.getAttribute('data-index'); // Ambil indeks rectifier dari atribut data-index

        const batterySection = document.getElementById(`battery-section-${rectifierIndex}`); // Ambil elemen battery section berdasarkan indeks

        if (!batterySection) {
            console.error(`Battery section not found for rectifier index: ${rectifierIndex}`);
            return;
        }

        const newBatteryField = `
            <div class="input-group mb-3 battery-fields">
                <select class="form-select" name="rectifiers[${rectifierIndex}][battery_quantity][]" required>
                    <option hidden>-- Battery Qty --</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
                <select class="form-select" name="rectifiers[${rectifierIndex}][battery_status][]" required>
                    <option hidden>Battery Status</option>
                    <option value="Good">Good</option>
                    <option value="Degraded">Degraded</option>
                    <option value="Stolen">Stolen</option>
                </select>
                <button class="btn btn-outline-danger remove-battery-btn" type="button">Remove</button>
            </div>
        `;

        batterySection.insertAdjacentHTML('beforeend', newBatteryField);
    }
});

document.addEventListener('click', function (event) {
    if (event.target && event.target.classList.contains('remove-battery-btn')) {
        event.target.closest('.battery-fields').remove(); // Hapus elemen baterai yang relevan
    }
});

                document.addEventListener('click', function (event) {
                    if (event.target && event.target.classList.contains('remove-battery-btn')) {
                        event.target.closest('.battery-fields').remove();
                    }
                });

                </script>
            </div>
        </div>
    </div>
@endsection
