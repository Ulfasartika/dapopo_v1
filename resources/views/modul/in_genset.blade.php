@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('genset.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1: Site Information -->
                        <div class="form-step">
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="form-select" id="selectSite" name="id_site" required>
                                    <option disabled selected hidden>-- Select Site --</option>
                                    @foreach ($site as $site)
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
                            <a href="{{ route('genset.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>
                        <div class="form-step d-none">
                            <h4>Step 2: Genset Information</h4>                        
                            <div id="genset-count-section">
                                <div class="mb-3">
                                    <label for="genset-count" class="form-label">Generator Quantity</label>
                                    <input type="number" class="form-control" id="genset-count" min="1" placeholder="Masukkan jumlah generator">
                                </div>
                                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                                <button type="button" class="btn btn-primary" id="generate-genset-forms">Next</button>
                            </div>                    
                        </div>
                        
                        <div class="form-step d-none">
                            <h4>Step 3: Genset Details</h4>
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
                        const gensetCount = parseInt(document.getElementById('genset-count').value, 10);
                        return !isNaN(gensetCount) && gensetCount > 0;
                        }
                        return true;
                    }

            const gensetCountSection = document.getElementById('genset-count-section');
            const gensetSection = document.getElementById('genset-section');
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
                    <label for="gensets[${i}][brand]" class="form-label">Brand</label>
                    <input type="text" class="form-control" name="gensets[${i}][brand]" required>
                </div>
                <div class="mb-3">
                    <label for="gensets[${i}][capacity]" class="form-label">Capacity (kVA)</label>
                    <input type="number" class="form-control" name="gensets[${i}][capacity]" step="0.1" required>
                </div>
                <div class="mb-3">
                    <label for="gensets[${i}][condition]" class="form-label">Genset Condition</label>
                    <select class="form-select" name="gensets[${i}][condition]" required>
                        <option disabled selected hidden>-- Select Condition --</option>
                        <option value="Good">Good</option>
                        <option value="Damaged">Damaged</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gensets[${i}][ats]" class="form-label">ATS</label>
                    <select class="form-select" name="gensets[${i}][ats]" required>
                        <option disabled selected hidden>-- Select Condition --</option>
                        <option value="Good">Good</option>
                        <option value="Damaged">Damaged</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gensets[${i}][photo_genset]" class="form-label">Genset Photo</label>
                    <small>Foto tampak depan Genset menggunakan kamera timestamp</small>
                    <input type="file" class="form-control" name="gensets[${i}][photo_genset]" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="gensets[${i}][photo_ats]" class="form-label">ATS Photo</label>
                    <small>Foto tampak depan ATS menggunakan kamera timestamp</small>
                    <input type="file" class="form-control" name="gensets[${i}][photo_ats]" accept="image/*" required>
                </div>
            </div>
        `;
        gensetSection.innerHTML += gensetForm;
    }

    // Move to the next step
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
                </script>
            </div>
        </div>
    </div>
@endsection
