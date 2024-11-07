@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card border-top border-0 border-primary">
        <div class="card-body">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-card me-1 font-22 text-primary"></i></div>
                    <h5 class="mb-0 text-primary">Form Edit Site</h5>
                </div>
                <hr>
                <form action="{{ route('site.update', $site->id) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')        
                    <div class="col-md-12">
                        <label for="editSiteId" class="form-label">Site ID</label>
                        <input type="text" name="site_id" class="form-control" id="editSiteId" value="{{ old('site_id', $site->site_id) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="editSiteName" class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="editSiteName" value="{{ old('site_name', $site->site_name) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="area_id" class="form-label">Select Area</label>
                        <select class="form-select" name="area_id" id="area_id" required>
                            <option value="">Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ $site->area_id == $area->id ? 'selected' : '' }}>
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>                    
                    </div>

                    <div class="col-md-12">
                        <label for="editAddress" class="form-label">Address</label>
                        <textarea name="address" class="form-control" id="editAddress" rows="3" required>{{ old('address', $site->address) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        <a href="{{ route('site.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
