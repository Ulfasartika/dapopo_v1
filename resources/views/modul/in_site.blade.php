@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-card me-1 font-22 text-primary"></i></div>
                    <h5 class="mb-0 text-primary">Form Input Site</h5>
                </div>
                <hr>
                <form action="{{ route('site.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="inputSiteId" class="form-label">Site ID</label>
                        <input type="text" name="site_id" class="form-control" id="inputSiteId" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputSiteName" class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="inputSiteName" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputAddress" class="form-label">Address</label>
                        <textarea name="address" class="form-control" id="inputAddress" placeholder="Address..." rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="{{ route('site.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
