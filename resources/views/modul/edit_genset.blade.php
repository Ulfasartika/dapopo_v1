@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="container mt-5">
                <form id="multi-step-form" action="{{ route('genset.update', $genset->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Step 1: Site Information -->
                    <div class="form-step">
                        <h4>Step 1: Site Information</h4>
                        <div class="mb-3">
                            <label for="selectSite" class="form-label">Site ID</label>
                            <select class="form-select" id="selectSite" name="id_site" required>
                                @foreach ($site as $site)
                                    <option value="{{ $site->id }}" {{ $genset->id_site == $site->id ? 'selected' : '' }}>
                                        {{ $site->site_id }} - {{ $site->site_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('genset.index') }}" class="btn btn-secondary btn-md">Cancel</a>
                        <button type="button" class="btn btn-primary next-step">Next</button>
                    </div>

                    <!-- Step 2: Genset Information -->
                    <div class="form-step d-none">
                        <h4>Step 2: Genset Information</h4>
                        <div class="mb-3">
                            <label for="gensetBrand" class="form-label">Genset Brand</label>
                            <input type="text" class="form-control" id="gensetBrand" name="genset_brand" value="{{ $genset->genset_brand }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" value="{{ $genset->capacity }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gensetCondition" class="form-label">Genset Condition</label>
                            <select id="gensetCondition" class="form-select single-select" name="genset_condition">
                                <option value="">--</option>
                                <option
                                    value="Good"{{ old('genset_condition', $genset->genset_condition) == 'Good' ? 'selected' : '' }}>
                                    Good</option>
                                <option value="Damaged"
                                    {{ old('genset_condition', $genset->genset_condition) == 'Damaged' ? 'selected' : '' }}>
                                    Damaged</option>
                            </select>                        
                        </div>
                        <div class="mb-3">
                            <label for="atsCondition" class="form-label">ATS Condition</label>
                            <select id="atsCondition" class="form-select single-select" name="ats">
                                <option value="">--</option>
                                <option
                                    value="Good"{{ old('ats', $genset->ats) == 'Good' ? 'selected' : '' }}>
                                    Good</option>
                                <option value="Damaged"
                                    {{ old('ats', $genset->ats) == 'Damaged' ? 'selected' : '' }}>
                                    Damaged</option>
                            </select>                        
                        </div>
                        <!-- Image Section -->
                        <div class="mb-3">
                            <label for="current_ats_image" class="form-label">Current ATS Image</label>
                            <div>
                                @if ($genset->foto_ats)
                                <img src="{{ Storage::url($genset->foto_ats) }}" 
                                     alt="Current ATS Image" 
                                     class="img-fluid mb-2" 
                                     style="max-width: 200px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto_ats" class="form-label">Upload ATS Image</label>
                            <small class="form-text text-muted">Foto Tampak Depan ATS</small>
                            <input type="file" class="form-control" name="foto_ats" accept="image/*">                        
                        </div>
                        <!-- Image Section -->
                        <div class="mb-3">
                            <label for="current_genset_image" class="form-label">Current Genset Image</label>
                            <div>
                                @if ($genset->foto_genset)
                                <img src="{{ Storage::url($genset->foto_genset) }}" 
                                     alt="Current Genset Image" 
                                     class="img-fluid mb-2" 
                                     style="max-width: 200px;">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto_genset" class="form-label">Upload New Image</label>
                            <small class="form-text text-muted">Foto Tampak Depan Genset</small>
                            <input type="file" class="form-control" name="foto_genset" accept="image/*">                        
                        </div>
                        <a href="{{ route('genset.index') }}" class="btn btn-secondary btn-md">Cancel</a>
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
