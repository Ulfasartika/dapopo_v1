@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-station me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Input Equipment</h5>
                    </div>
                    <hr>
                    <form action="{{ route('equipment.store') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <label for="inputEquipment" class="form-label">Equipment</label>
                            <input type="text" name="equipment_name" class="form-control" id="inputEquipment">
                        </div>
                        @error('equipment_name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('equipment.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
