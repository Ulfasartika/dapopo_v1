@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-station me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Edit Battery Type</h5>
                    </div>
                    <hr>
                    <form action="{{ route('battery_type.update', $battery_type->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="editBatteryType" class="form-label">Battery Type</label>
                            <input type="text" name="battery_type" class="form-control" id="editBatteryType"
                                value="{{ old('battery_type', $battery_type->battery_type) }}" required>
                        </div>
                        @error('battery_type')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('battery_type.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
