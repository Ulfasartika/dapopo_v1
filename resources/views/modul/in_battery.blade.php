@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bx-battery me-1 font-22 text-primary"></i></div>
                    <h5 class="mb-0 text-primary">Form Input Battery</h5>
                </div>
                <hr>
                <form action="{{ route('battery.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-12">
                        <label for="inputBatteryBrand" class="form-label">Battery Brand</label>
                        <input type="text" name="merk_battery" class="form-control" id="inputBatteryBrand" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        <a href="{{ route('battery.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
