@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('rectifier.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1: Site Information -->
                        <div class="form-step">
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="form-select single-select" id="selectSite" name="id_site">
                                    <option hidden>-- Select Site --</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">
                                            {{ $site->site_id }} - {{ $site->site_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_site')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <a href="{{ route('rectifier.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 2: Customer Information -->
                        <div class="form-step d-none">
                            <h4>Step 2: PLN Information</h4>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan">
                            </div>
                            @error('id_pelanggan')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="daya" class="form-label">Daya PLN (kvA)</label>
                                <input type="number" class="form-control" id="daya" name="daya" step="0.1">
                            </div>
                            @error('daya')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 3: Rectifier and Battery Information -->
                        <div class="form-step d-none">
                            <h4>Step 3: Rectifier and Battery Information</h4>
                            <div id="rectifier-section">
                            <div id="rectifier-form mb-3">
                            <div class="mb-3">
                                <label for="recti_name" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" id="recti_name" name="recti_name" readonly>
                            </div>
                            @error('recti_name')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inRectiBrand" class="form-label">Rectifier Brand</label>
                                <select id="inRectiBrand" name="recti_brand" class="form-select single-select">
                                    <option hidden value="">-- Select Brand --</option>
                                    <option value="Emerson">Emerson</option>
                                    <option value="Hariff">Hariff</option>
                                    <option value="Vertiv">Vertiv</option>
                                </select>
                            </div>
                            @error('recti_brand')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label" for="inAprQuantity">APR Quantity</label>
                                <select class="form-select single-select" id="inAprQuantity" name="apr_quantity">
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
                            @error('apr_quantity')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="bus_voltage" class="form-label">Bus Voltage (V)</label>
                                <input type="number" class="form-control" id="bus_voltage" name="bus_voltage"
                                    step="0.1">
                            </div>
                            @error('bus_voltage')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="load" class="form-label">Load (A)</label>
                                <input type="number" class="form-control" id="load" name="load" step="0.1">
                            </div>
                            @error('load')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inBatteryBrand" class="form-label">Battery Brand</label>
                                <select id="inBatteryBrand" class="form-select single-select" name="battery_brand">
                                    <option hidden>-- Select Brand --</option>
                                    <option value="Sacredsun">Sacredsun</option>
                                    <option value="ZTE">ZTE</option>
                                    <option value="Sonneinchen">Sonneinchen</option>
                                    <option value="Maxlife">Maxlife</option>
                                </select>
                            </div>
                            @error('battery_brand')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inBatteryType" class="form-label">Battery Type</label>
                                <select id="inBatteryType" class="form-select single-select" name="battery_type" requireds>
                                    <option hidden>-- Select Type --</option>
                                    <option value="Lithium">Lithium</option>
                                    <option value="VRLA">VRLA</option>
                                </select>
                            </div>
                            @error('battery_type')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div id="battery-section">
                                <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                                <div class="input-group mb-3 battery-fields">
                                    <select class="form-select" id="batteryQuantity" name="battery_quantity[]" required>
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
                                    <select class="form-select" name="battery_status[]" required>
                                        <option hidden>Battery Status</option>
                                        <option value="Good">Good</option>
                                        <option value="Degraded">Degraded</option>
                                        <option value="Stolen">Stolen</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add
                                        Battery</button>
                                </div>
                                @error('battery_quantity')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="backup_time" class="form-label">Backup Time (Hour)</label>
                                <input type="number" class="form-control" id="backup_time" name="backup_time">
                            </div>
                            @error('backup_time')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="id_equipment" class="form-label">Equipment</label>
                                <select class="multiple-select" id="id_equipment" name="id_equipment[]"
                                    multiple="multiple">
                                    @foreach ($equipments as $equip)
                                        <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_equipment')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <small class="form-text text-muted">Please upload an image captured with a camera that
                                    includes a timestamp.</small>
                                <input type="file" name="image" id="gambarRectiInput" accept="image/png, image/jpeg"
                                    class="form-control" onchange="previewImage(this)">
                                <div class="mt-2" hidden>
                                    <img src="" alt="" id="gambarRectiPreview"
                                        style="max-width: 100%; height: 300px;  display:block; margin:auto;">
                                </div>
                            </div>
                            </div>
                            </div>
                            <br>
                            <button type="button" class="btn btn-secondary prev-step">Previous</button>
                            <button class="btn btn-outline-secondary" type="button" id="add-rectifier">Add Rectifier</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

                <script>
                    function previewImage(input) {
                        var preview = document.getElementById('gambarRectiPreview');
                        var fileInput = input.files[0];
                        var previewContainer = preview.parentElement;

                        if (fileInput) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.style.display = 'block';
                                previewContainer.removeAttribute('hidden');
                            };

                            reader.readAsDataURL(fileInput);
                        }
                    }

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

                    document.getElementById('selectSite').addEventListener('change', function() {
                        const siteId = this.value;
                        if (siteId) {
                            fetch(`/api/site/${siteId}/rectifiers-count`)
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById('recti_name').value = `Rectifier ${data.count + 1}`;
                                })
                                .catch(error => console.error('Error:', error));
                        } else {
                            document.getElementById('recti_name').value = '';
                        }
                    });

                    document.getElementById('button-addon2').addEventListener('click', function() {
                        const batterySection = document.getElementById('battery-section');
                        const newField = document.createElement('div');
                        newField.classList.add('input-group', 'mb-3', 'battery-fields');
                        newField.innerHTML = `
                            <select class="form-select" name="battery_quantity[]" required>
                                <option selected>Choose...</option>
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
                            <select class="form-select" name="battery_status[]" required>
                                <option selected hidden>Battery Status</option>
                                <option value="Good">Good</option>
                                <option value="Degraded">Degraded</option>
                                <option value="Stolen">Stolen</option>
                            </select>
                            <button type="button" class="btn btn-outline-danger remove-battery">Remove Battery</button>
                        `;
                        batterySection.appendChild(newField);

                        newField.querySelector('.remove-battery').addEventListener('click', function() {
                            newField.remove();
                        });
                    });

                    let rectifierIndex = 0;
                    document.getElementById('add-rectifier').addEventListener('click', function() {
                        const rectifierSection = document.getElementById('rectifier-section');
                        const newForm = document.createElement('div');
                        newForm.classList.add('rectifier-form', 'mb-3');
                        newForm.innerHTML = `
                        <br>
                            <div class="mb-3">
                                <label for="recti_name_${rectifierIndex}" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" id="recti_name_${rectifierIndex}" name="recti_name_${rectifierIndex}" readonly>
                            </div>
                            @error('recti_name_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inRectiBrand_${rectifierIndex}" class="form-label">Rectifier Brand</label>
                                <select id="inRectiBrand_${rectifierIndex}" name="recti_brand_${rectifierIndex}" class="form-select single-select">
                                    <option hidden value="">-- Select Brand --</option>
                                    <option value="Emerson">Emerson</option>
                                    <option value="Hariff">Hariff</option>
                                    <option value="Vertiv">Vertiv</option>
                                </select>
                            </div>
                            @error('recti_brand_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label class="form-label" for="inAprQuantity_${rectifierIndex}">APR Quantity</label>
                                <select class="form-select single-select" id="inAprQuantity_${rectifierIndex}" name="apr_quantity_${rectifierIndex}">
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
                            @error('apr_quantity_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="bus_voltage_${rectifierIndex}" class="form-label">Bus Voltage (V)</label>
                                <input type="number" class="form-control" id="bus_voltage_${rectifierIndex}" name="bus_voltage_${rectifierIndex}"
                                    step="0.1">
                            </div>
                            @error('bus_voltage_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="load_${rectifierIndex}" class="form-label">Load (A)</label>
                                <input type="number" class="form-control" id="load_${rectifierIndex}" name="load_${rectifierIndex}" step="0.1">
                            </div>
                            @error('load_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inBatteryBrand_${rectifierIndex}" class="form-label">Battery Brand</label>
                                <select id="inBatteryBrand_${rectifierIndex}" class="form-select single-select" name="battery_brand_${rectifierIndex}">
                                    <option hidden>-- Select Brand --</option>
                                    <option value="Sacredsun">Sacredsun</option>
                                    <option value="ZTE">ZTE</option>
                                    <option value="Sonneinchen">Sonneinchen</option>
                                    <option value="Maxlife">Maxlife</option>
                                </select>
                            </div>
                            @error('battery_brand_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="inBatteryType_${rectifierIndex}" class="form-label">Battery Type</label>
                                <select id="inBatteryType_${rectifierIndex}" class="form-select single-select" name="battery_type_${rectifierIndex}" requireds>
                                    <option hidden>-- Select Type --</option>
                                    <option value="Lithium">Lithium</option>
                                    <option value="VRLA">VRLA</option>
                                </select>
                            </div>
                            @error('battery_type_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div id="battery-section">
                                <label class="form-label" for="batteryQuantity_${rectifierIndex}">Battery Quantity</label>
                                <div class="input-group mb-3 battery-fields">
                                    <select class="form-select" id="batteryQuantity_${rectifierIndex}" name="battery_quantity[]_${rectifierIndex}" required>
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
                                    <select class="form-select" name="battery_status[]_${rectifierIndex}" required>
                                        <option hidden>Battery Status</option>
                                        <option value="Good">Good</option>
                                        <option value="Degraded">Degraded</option>
                                        <option value="Stolen">Stolen</option>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add
                                        Battery</button>
                                </div>
                                @error('battery_quantity_${rectifierIndex}')
                                    <div class="mt-2 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="backup_time_${rectifierIndex}" class="form-label">Backup Time (Hour)</label>
                                <input type="number" class="form-control" id="backup_time_${rectifierIndex}" name="backup_time_${rectifierIndex}">
                            </div>
                            @error('backup_time_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="id_equipment_${rectifierIndex}" class="form-label">Equipment</label>
                                <select class="multiple-select" id="id_equipment_${rectifierIndex}" name="id_equipment[]_${rectifierIndex}"
                                    multiple="multiple">
                                    @foreach ($equipments as $equip)
                                        <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_equipment_${rectifierIndex}')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="gambarRectiInput_${rectifierIndex}" class="form-label">Upload Image</label>
                                <small class="form-text text-muted">Please upload an image captured with a camera that
                                    includes a timestamp.</small>
                                <input type="file" name="image_${rectifierIndex}" id="gambarRectiInput_${rectifierIndex}" accept="image/png, image/jpeg"
                                    class="form-control" onchange="previewImage(this)">
                                <div class="mt-2" hidden>
                                    <img src="" alt="" id="gambarRectiPreview_${rectifierIndex}"
                                        style="max-width: 100%; height: 300px;  display:block; margin:auto;">
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger remove-rectifier">Remove Rectifier</button>
                        `;
                        rectifierSection.appendChild(newForm);
                        $(newForm).find('.multiple-select').select2({
                            theme: 'bootstrap4',
                            width: '100%',
                            placeholder: 'Select an option',
                            allowClear: true,
                        });

                        newForm.querySelector('.remove-rectifier').addEventListener('click', function() {
                            newForm.remove();
                        });

                        rectifierIndex++;
                    });

                </script>
            </div>
        </div>
    </div>
@endsection
