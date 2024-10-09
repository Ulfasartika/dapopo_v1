@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="lni lni-bolt-alt me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Input KWh</h5>
                    </div>
                    <hr>
                    <form action="{{ route('kwh.store') }}" method="POST" class="row g-3">
                        @csrf
                        <!-- Select Site ID -->
                        <div class="col-md-12">
                            <label for="inputSiteId" class="form-label">Site ID</label>
                            <select name="site_id" class="form-control" id="inputSiteId" required>
                                <option value="">Select Site ID</option>
                                @foreach($data as $site)
                                    <option value="{{ $site->site_id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input ID Pelanggan -->
                        <div class="col-md-12">
                            <label for="inputIdPelanggan" class="form-label">ID Pelanggan</label>
                            <input type="text" name="id_pelanggan" class="form-control" id="inputIdPelanggan" required>
                        </div>

                        <!-- Input Daya -->
                        <div class="col-md-12">
                            <label for="inputDaya" class="form-label">Daya</label>
                            <input type="text" name="daya" class="form-control" id="inputDaya" required>
                        </div>

                        <!-- Submit and Cancel Buttons -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Submit</button>
                            <a href="{{ route('kwh.index') }}" class="btn btn-secondary px-5">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
