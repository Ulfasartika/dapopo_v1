@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-station me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Input Battery Brand</h5>
                    </div>
                    <hr>
                    <form action="#" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <label for="inputBatteryBrand" class="form-label">Battery Brand</label>
                            <input type="text" name="battery_brand" class="form-control" id="inputBatteryBrand">
                        </div>
                        @error('battery_brand')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="#" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
