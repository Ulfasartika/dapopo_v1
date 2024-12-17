@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <form id="multi-step-form" action="{{ route('kwh.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1: Site Information -->
                        <div class="form-step">
                            <h4>Step 1: Site Information</h4>
                            <div class="mb-3">
                                <label for="selectSite" class="form-label">Site ID</label>
                                <select class="form-select" id="selectSite" name="id_site" required>
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
                            <a href="{{ route('kwh.index') }}" class="btn btn-secondary">Cancel</a>
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
                                <label for="arusPln" class="form-label">Arus (A) PLN</label>
                                <input type="number" class="form-control" id="arusPln" name="arus_pln" required>
                            </div>
                            <div class="mb-3">
                                <label for="phasa1" class="form-label">Phasa 1 (V)</label>
                                <input type="number" class="form-control" id="phasa1" name="phasa_1">
                            </div>
                            <div class="mb-3">
                                <label for="phasa2" class="form-label">Phasa 2 (V)</label>
                                <input type="number" class="form-control" id="phasa2" name="phasa_2">
                            </div>
                            <div class="mb-3">
                                <label for="phasa3" class="form-label">Phasa 3 (V)</label>
                                <input type="number" class="form-control" id="phasa3" name="phasa_3">
                            </div>
                            <div class="mb-3">
                                <label for="fotoKwh" class="form-label">Upload Image</label>
                                <br>
                                <small>Foto tampak depan KWh Meter dengan pintu terbuka menggunakan kamera timestamp</small>
                                <input type="file" name="foto_kwh" accept="image/png, image/jpeg" class="form-control" required>
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
                        return true;
                    }

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
