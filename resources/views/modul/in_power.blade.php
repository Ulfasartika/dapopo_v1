@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('power.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1: Site Information -->
                        <div class="form-step"> <!-- Step 1 -->
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="single-select" id="selectSite" name="id_site" required>
                                    <option disabled selected hidden>-- Select Site --</option>
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
                            <a href="{{ route('power.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <div class="form-step d-none"> <!-- Step 2 -->
                            <h4>Step 2: PLN Information</h4>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" maxlength="12" pattern="\d+" required>
                            </div>
                            <div class="mb-3">
                                <label for="daya" class="form-label">Daya PLN (kvA)</label>
                                <input type="number" class="form-control" id="daya" name="daya" step="0.1" required>
                            </div>
                            <div class="mb-3">
                                <label for="kondisiKwh" class="form-label">Kondisi KWh Meter</label>
                                <select name="kondisi_kwh" class="form-select" id="kondisiKwh">
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Terbakar">Terbakar</option>
                                    <option value="Bypass">Bypass</option>
                                </select>                            
                            </div>
                            <div class="mb-3">
                                <label for="kondisiSegel" class="form-label">Kondisi Segel</label>
                                <select name="kondisi_segel" class="form-select" id="kondisiSegel">
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="Bersegel">Bersegel</option>
                                    <option value="Tidak Bersegel">Tidak Bersegel</option>
                                </select>                            
                            </div>
                            <div class="mb-3">
                                <label for="arusR" class="form-label">Arus R (A)</label>
                                <input type="number" class="form-control" id="arusR" name="arus_r" required>
                            </div>
                            <div class="mb-3">
                                <label for="arusS" class="form-label">Arus S (A)</label>
                                <input type="number" class="form-control" id="arusS" name="arus_s" required>
                            </div>
                            <div class="mb-3">
                                <label for="arusT" class="form-label">Arus T (A)</label>
                                <input type="number" class="form-control" id="arusT" name="arus_t" required>
                            </div>
                            <div class="mb-3">
                                <label for="phasaR" class="form-label">Phasa R (V)</label>
                                <input type="number" class="form-control" id="phasaR" name="phasa_r">
                            </div>
                            <div class="mb-3">
                                <label for="phasaS" class="form-label">Phasa S (V)</label>
                                <input type="number" class="form-control" id="phasaS" name="phasa_s">
                            </div>
                            <div class="mb-3">
                                <label for="phasaT" class="form-label">Phasa T (V)</label>
                                <input type="number" class="form-control" id="phasaT" name="phasa_t">
                            </div>
                            <div class="mb-3">
                                <label for="fotoKwh" class="form-label">Upload Image</label>
                                <br>
                                <small>Foto tampak depan KWh Meter dengan pintu terbuka</small>
                                <input type="file" name="foto_kwh" accept="image/png, image/jpeg" class="form-control">
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
                            <h4>Step 3: Jumlah Rectifier</h4>
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
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                        <div class="form-step d-none"> <!-- Step 5 -->
                            <h4>Step 5: Genset Information</h4>
                        
                            <!-- Question about genset -->
                            <div class="mb-3">
                                <label for="genset-option" class="form-label">This site have generator</label>
                                <select class="form-select" id="genset-option" required>
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        
                            <!-- Input jumlah genset (hidden by default) -->
                            <div id="genset-count-section" class="d-none">
                                <div class="mb-3">
                                    <label for="genset-count" class="form-label">Generator Quantity</label>
                                    <input type="number" class="form-control" id="genset-count" min="1" placeholder="Masukkan jumlah generator">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary" id="generate-genset-forms">Next</button>
                            </div>
                        
                            <!-- Button Submit langsung jika tidak ada genset -->
                            <div id="no-genset-submit-section" class="d-none">
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>      
                        </div>
                        
                        <div class="form-step d-none"> <!-- Step 6 -->
                            <h4>Step 6: Genset Details</h4>
                            <div id="genset-section"></div>
                        
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
                        if (stepIndex === 4) {
                            const gensetOption = document.getElementById('genset-option').value;
                            if (gensetOption === 'yes') {
                                const gensetCount = document.getElementById('genset-count').value;
                                return gensetCount && gensetCount > 0;
                            }
                            if (gensetOption === 'no') {
                                return true;
                            }
                            return false;
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
                            <input type="text" class="form-control" name="rectifiers[${i}][recti_name]">
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
                            <br>
                            <small>Foto tampak depan rectifier dengan pintu terbuka</small>
                            <input type="file" name="rectifiers[${i}][image]" accept="image/png, image/jpeg" class="form-control">
                        </div>
                    </div>
                `;
                rectifierSection.innerHTML += newRectifierForm;
            }

            const gensetOption = document.getElementById('genset-option');
            const gensetCountSection = document.getElementById('genset-count-section');
            const noGensetSubmitSection = document.getElementById('no-genset-submit-section');
            const gensetSection = document.getElementById('genset-section');

            gensetOption.addEventListener('change', function () {
                const value = this.value;

                if (value === 'yes') {
                    gensetCountSection.classList.remove('d-none');
                    noGensetSubmitSection.classList.add('d-none');
                } else if (value === 'no') {
                    gensetCountSection.classList.add('d-none');
                    noGensetSubmitSection.classList.remove('d-none');
                }
            });

             // Generate Genset Forms
    document.getElementById('generate-genset-forms').addEventListener('click', function () {
        const gensetCount = parseInt(document.getElementById('genset-count').value, 10);

        if (isNaN(gensetCount) || gensetCount <= 0) {
            alert('Masukkan jumlah genset yang valid.');
            return;
        }

        gensetSection.innerHTML = ''; // Clear previous forms

        for (let i = 0; i < gensetCount; i++) {
            const gensetForm = `
                <div class="genset-form mb-4">
                    <h5>Genset ${i + 1}</h5>
                    <div class="mb-3">
                        <label for="gensets[${i}][genset_name]" class="form-label">Genset Name</label>
                        <input type="text" class="form-control" name="gensets[${i}][genset_name]" required>
                    </div>
                    <div class="mb-3">
                        <label for="gensets[${i}][brand]" class="form-label">Brand</label>
                        <input type="text" class="form-control" name="gensets[${i}][brand]" required>
                    </div>
                    <div class="mb-3">
                    <label for="gensets[${i}][capacity]" class="form-label">Capacity (kVA)</label>
                    <select class="single-select" name="gensets[${i}][capacity]" required>
                        <option disabled selected hidden>-- Select Capacity --</option>
                        <option value="20" data-numeric="20">20</option>
                        <option value="22" data-numeric="22">22</option>
                        <option value="22.5" data-numeric="22.5">22.5</option>
                        <option value="30" data-numeric="30">30</option>
                        <option value="40" data-numeric="40">40</option>
                        <option value="50" data-numeric="50">50</option>
                        <option value="60" data-numeric="60">60</option>
                        <option value="80" data-numeric="80">80</option>
                    </select>
                    </div>                    
                <div class="mb-3">
                        <label for="gensets[${i}][condition]" class="form-label">Genset Condition</label>
                        <select class="form-select" name="gensets[${i}][condition]" required>
                            <option disabled selected hidden>-- Select Condition --</option>
                            <option value="Bagus">Bagus</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gensets[${i}][ats]" class="form-label">ATS</label>
                        <select class="form-select" name="gensets[${i}][ats]" required>
                            <option disabled selected hidden>-- Select Condition --</option>
                            <option value="Bagus">Bagus</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="gensets[${i}][photo_genset]" class="form-label">Genset Photo</label>
                    <input type="file" class="form-control" name="gensets[${i}][photo_genset]" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                    <label for="gensets[${i}][photo_ats]" class="form-label">ATS Photo</label>
                    <input type="file" class="form-control" name="gensets[${i}][photo_ats]" accept="image/*" required>
                    </div>
                </div>
            `;
            gensetSection.innerHTML += gensetForm;
        $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
	});
        }

        steps[currentStep].classList.add('d-none');
        currentStep++;
        steps[currentStep].classList.remove('d-none');
    });

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
