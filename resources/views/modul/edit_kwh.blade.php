@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="container mt-5">
                <form id="multi-step-form" action="{{ route('kwh.update', $kwh->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Step 1: Site Information -->
                    <div class="form-step">
                        <h4>Step 1: Site Information</h4>
                        <div class="mb-3">
                            <label for="selectSite" class="form-label">Site ID</label>
                            <select class="form-select" id="selectSite" name="id_site" required>
                                @foreach ($site as $singleSite)
                                    <option value="{{ $singleSite->id }}" 
                                        {{ $kwh->id_site == $singleSite->id ? 'selected' : '' }}>
                                        {{ $singleSite->site_id }} - {{ $singleSite->site_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('kwh.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <!-- Step 2: Genset Information -->
                    <div class="form-step d-none">
                        <h4>Step 2: KWh Meter Information</h4>
                        <div class="mb-3">
                            <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                            <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="{{ $kwh->id_pelanggan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="daya" class="form-label">Daya (kVA)</label>
                            <input type="number" class="form-control" id="daya" name="daya" value="{{ $kwh->daya }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kondisi_kwh" class="form-label">KWh Meter Condition</label>
                            <select id="kondisi_kwh" class="form-select single-select" name="kondisi_kwh">
                                <option value="">--</option>
                                <option
                                    value="Bagus"{{ old('kondisi_kwh', $kwh->kondisi_kwh) == 'Bagus' ? 'selected' : '' }}>
                                    Bagus</option>
                                <option value="Terbakar"
                                    {{ old('kondisi_kwh', $kwh->kondisi_kwh) == 'Terbakar' ? 'selected' : '' }}>
                                    Terbakar</option>
                                <option value="Bypass"
                                {{ old('kondisi_kwh', $kwh->kondisi_kwh) == 'Bypass' ? 'selected' : '' }}>
                                Bypass</option>
                            </select>                        
                        </div>
                        <div class="mb-3">
                            <label for="arusPln" class="form-label">Arus (A) PLN</label>
                            <input type="number" class="form-control" id="arusPln" name="arus_pln" value="{{ $kwh->arus_pln }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phasa1" class="form-label">Phasa 1 (V)</label>
                            <input type="number" class="form-control" id="phasa1" name="phasa_1" value="{{ $kwh->phasa_1 }}">
                        </div>
                        <div class="mb-3">
                            <label for="phasa2" class="form-label">Phasa 2 (V)</label>
                            <input type="number" class="form-control" id="phasa2" name="phasa_2" value="{{ $kwh->phasa_2 }}">
                        </div>
                        <div class="mb-3">
                            <label for="phasa3" class="form-label">Phasa 3 (V)</label>
                            <input type="number" class="form-control" id="phasa3" name="phasa_3" value="{{ $kwh->phasa_3 }}">
                        </div>

                        <!-- Image Section -->
                        <div class="mb-3">
                            <label for="current_kwh_image" class="form-label">Current KWh Image</label>
                            <div>
                                @if ($kwh->foto_kwh)
                                <img src="{{ Storage::url($kwh->foto_kwh) }}" 
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
                        <a href="{{ route('kwh.index') }}" class="btn btn-secondary btn-md">Cancel</a>
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
    </script>
</div>
@endsection
